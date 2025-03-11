<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Services\IzinService;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Persensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IzinController extends Controller
{
    public $izin;
    public function __construct(IzinService $izinService)
    {
        $this->izin = $izinService;
    }
    public function index()
    {
        if (\request()->ajax()) {
            $minutes = 720;

            if (\request()->tanggal_awal && \request()->tanggal_akhir) {
                $izin = $this->izin->Query();
                $tgl_awal = Carbon::parse(\request()->tanggal_awal)->toDateTimeString();
                $tgl_akhir = Carbon::parse(\request()->tanggal_akhir)->toDateTimeString();
                $data['table'] = $izin->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->paginate(6);
                return view('users.izin._data_table_cuty', $data);
            }

            $data['table']  = Cache::remember('cuty_' . Auth::user()->id, $minutes, function () {
                return Izin::where('user_id', auth()->user()->id)->latest()->paginate(6);
            });
            return view('users.izin._data_table_cuty', $data);
        }

        $data['title']  = 'Data Izin';
        return view('users.izin.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_awal'  => 'required|max:255',
            'tanggal_akhir' => 'required|max:255',
            'tanggal_masuk' => 'required|max:255',
            'jumlah_izin'   => 'required|max:255',
            'keterangan'    => 'string|max:255',
            'lampiran'      => 'file|mimes:jpg,jpeg,png|max:4048'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }
        
        $data = $validator->validated();

        $data['tanggal_awal']   = Carbon::parse($request->tanggal_awal)->format('Y-m-d');
        $data['tanggal_akhir']  = Carbon::parse($request->tanggal_akhir)->format('Y-m-d');
        $data['tanggal_masuk']  = Carbon::parse($request->tanggal_masuk)->format('Y-m-d');

        if ($data['tanggal_awal'] >  $data['tanggal_akhir']) {
            return $this->error('Tanggal mulai cuti lebih besar dari tanggal berakhir cuti');
        }

        if($data['tanggal_masuk'] < $data['tanggal_akhir']) {
            return $this->error('Tanggal masuk kerja lebih kecil dari tanggal berakhir cuti');
        }

        $izin = $this->izin->Query()
        ->where('user_id', Auth::user()->id)
        ->latest()
        ->first();

        if($izin && $izin->approval_status == 'pending') {
            return $this->warning("Ada permohonan cuti sebelumnya yang belum disetujui");
        }

        if($izin && $izin->approval_status == 'disetujui') {
            $tanggal_masuk_cuti = Carbon::createFromDate($izin->tanggal_masuk);
           // Periksa apakah tanggal tersebut sudah lewat dari hari ini
           if (!$tanggal_masuk_cuti->isPast()) {
               return $this->warning("Anda masih dalam masa cuti");
           }
        }

        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran');
            $fileName = time() . '.' . $lampiran->getClientOriginalExtension();
            $pathFile = 'cuti/' . Auth::id() . '/' . date('Y');
            $lampiran->storeAs($pathFile, $fileName, 's3');
            $data['lampiran'] = $fileName;
        }

        $data['user_id']    = Auth::id();
        $data['opd_id']     = Auth::user()->opd_id;

        DB::beginTransaction();
        try {
            $this->izin->store($data);
            //cek apakah user sebelumnya sudah mengisi presensi, jika ya hapus presensi hari ini karena user mengisi cuti
            $presensi = Persensi::where('user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today())
            ->first();
        
            if ($presensi && $presensi) {
                $presensi->delete();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            saveLogs($th->getMessage() . '-error ketika membuat surat izin-' . Auth::user()->nama, 'error');
            return $this->error($th->getMessage());
        }
        DB::commit();
        Cache::forget('cuty_' . Auth::user()->id);
        return $this->success($data, 'Permohonan berhasil dibuat');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_awal'  => 'required|max:255',
            'tanggal_akhir' => 'required|max:255',
            'tanggal_masuk' => 'required|max:255',
            'jumlah_izin'   => 'required|max:255',
            'lampiran'      => 'file|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data =$validator->validated();

        $data['tanggal_awal']   = Carbon::parse($request->tanggal_awal)->format('Y-m-d');
        $data['tanggal_akhir']  = Carbon::parse($request->tanggal_akhir)->format('Y-m-d');
        $data['tanggal_masuk']  = Carbon::parse($request->tanggal_masuk)->format('Y-m-d');

        $id = $request->id;
        $izin = $this->izin->find($id);

        if ($request->lampiran) {
            $lampiran = $request->file('lampiran');
            $fileName = time() . '.' . $lampiran->getClientOriginalExtension();
            $pathFile = 'cuti/' . Auth::id() . '/' . date('Y');
            $lampiran->storeAs($pathFile, $fileName, 's3');
            $data['lampiran'] = $fileName;

            Storage::disk('s3')->delete('cuti/' . Auth::id() . '/' . $izin->created_at->format('Y') . '/' . $izin->lampiran);
        }

        try {
            $this->izin->update($id, $data);
        } catch (\Throwable $th) {
            saveLogs($th->getMessage() . '-error ketika update data izin-' . Auth::user()->nama, 'error');
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Permohonan berhasil diupdate');
    }

    public function print(Request $request)
    {
        if (\request()->ajax()) {
            $absent = $this->izin->Query();
            if ($request->tanggal_awal && $request->tanggal_akhir) {
                $tgl_awal = Carbon::parse(\request()->tanggal_awal)->toDateTimeString();
                $tgl_akhir = Carbon::parse(\request()->tanggal_akhir)->toDateTimeString();
                $absent->whereBetween('created_at', [$tgl_awal, $tgl_akhir]);
            }

            $data['table'] = $absent->where('user_id', Auth::user()->id)->paginate();

            return view('users.izin._data_table_print', $data);
        }

        $data['title'] = 'Data Izin ' .  Auth::user()->nama;
        return view('users.izin.print', compact('data'));
    }
}
