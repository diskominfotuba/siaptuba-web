<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\KinerjaService;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class EkinController extends Controller
{
    public $kinerja;
    public function __construct(KinerjaService $kinerjaService)
    {
        $this->kinerja = $kinerjaService;
    }

    public function index()
    {

        $user = Auth::user();
        if(request()->ajax()) {

            $kinerja = $this->kinerja->Query();

            $page = request()->get('paginate', 10);
            
            if(\request()->month) {
                $kinerja->whereMonth('created_at', \request()->month);
            }

            if(\request()->search) {
                $kinerja->whereHas('user', function($query) {
                    $query->where('nama', 'like', '%' . \request()->search . '%');
                });
            }

            if($user->role == "oprator") {
                $data['table'] = $kinerja->where('opd_id', $user->opd->id)->with('user')->latest()->paginate($page);
            }else {
                $data['table'] = $kinerja->where('user_id', $user->id)->latest()->paginate($page);
            }

            return view('users.ekin._data_table', $data);
        }

        $data['title'] = "Ekinerja pegawai";

        if($user->role == 'oprator') {
            $data['tugas_hari_ini'] = $this->kinerja->Query()->where('opd_id', $user->opd->id)->whereDate('created_at', Carbon::today())->count();
            $data['total_tugas'] = $this->kinerja->Query()->where('opd_id', $user->opd->id)->count();
        }else {
            $data['tugas_hari_ini'] = $this->kinerja->Query()->where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count();
            $data['total_tugas'] = $this->kinerja->Query()->where('user_id', $user->id)->count();
        }
        
        return view('users.ekin.index', $data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();    

        if(!canAccessModule($user->opd->id, 'tugas-harian')) {
            return $this->warning('OPD Anda belum mengakfitkan fitur ini!');
        }

       if($request->base64) {
        $validator = Validator::make($request->all(), [
            'nama_tugas'    => 'required|string|max:100',
            'deskripsi'     => 'required|string|max:250',
            ]);

            $fileName = time() . '-' . now()->format('m')  . '.jpeg';
            $path = 'ekin/' . $user->opd->id . '/' . now()->format('Y') . '/' . $fileName;

            $image_parts = explode(";base64,", $request->base64);
            $image_type_aux = explode("image/", $image_parts[0]);

            // Memastikan format tipe gambar benar
            if (isset($image_type_aux[1])) {
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                // Menyimpan file dengan nama unik
                Storage::disk('s3')->put($path, $image_base64);
            }
       }else {
        // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_tugas'    => 'required|string|max:100',
                'deskripsi'     => 'required|string|max:250',
                'bukti_dukung'  => 'required|file|mimes:png,jpg,jpeg|max:5120'
            ]);

            // Mengunggah file jika ada
            $bukti_dukung = $request->file('bukti_dukung');
            $image = Image::make($bukti_dukung)
                ->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpeg', 75); // 75 adalah kualitas (0-100)
    
            $fileName = time() . '-' . now()->format('m')  . '.jpeg';
            $path = 'ekin/' . $user->opd->id . '/' . now()->format('Y') . '/' . $fileName;
            \Storage::disk('s3')->put($path, $image->stream());
       }

        if($validator->fails()) {
            return $this->error($validator->errors());
        }

        // Menyimpan data yang telah divalidasi
        $data = $validator->validated();

        $data['opd_id'] =  $user->opd->id;
        $data['user_id'] = $user->id;
        $data['bukti_dukung'] = $fileName;

        // Menyimpan data ke database dengan handling error
        try {
            $this->kinerja->store($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success('OK', 'Tugas Anda berhasil dibuat');
    }

    public function show($id)
    {
        if(\request()->ajax()) {
            $kinerja = $this->kinerja->find($id);
            if(!$kinerja) {
                return $this->error('Data kinerja tidak ditemukan!');
            }else {
                return $this->success($kinerja);
            }
        }
    }

    public function riwayat(Request $request)
    {
        if(\request()->ajax()) {
           $user = Auth::user();
           $page = request()->get('paginate', 10);
           if($user->role == 'oprator') {
               $data['table'] = $this->kinerja->Query()->where('opd_id', $user->opd->id)->paginate($page);
           }else {
               $data['table'] = $this->kinerja->Query()->where('user_id', $user->id)->paginate($page);
           }
           return view('users.ekin._data_table_riwayat', $data);
        }

        $data['title'] = 'Riwayat data tugas';
        return view('users.ekin.riwayat', $data);
    }

    public function destroy($id)
    {
        $kinerja = $this->kinerja->find($id);
        if(!$kinerja) {
            return $this->error('Data tugas tidak ditemukan!');
        }else {
            $kinerja->delete();
            Storage::disk('s3')->delete('ekin/' . $kinerja->opd_id . '/' . $kinerja->created_at->format('Y') . '/' . $kinerja->bukti_dukung);
            return $this->success('OK', 'Data tugas berhasil dihapus');
        }
    }
}
