<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\KegiatanService;
use App\Services\TamuService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class KegiatanController extends Controller
{
    protected $kegiatan;
    protected $tamu_undangan;
    public function __construct(KegiatanService $kegiatanService, TamuService $tamuService)
    {
        $this->kegiatan = $kegiatanService;
        $this->tamu_undangan = $tamuService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            if (\request()->tanggal_awal && \request()->tanggal_akhir) {
                $tamu_undangan = $this->tamu_undangan->Query();
                $tgl_awal = Carbon::parse(\request()->tanggal_awal)->toDateTimeString();
                $tgl_akhir = Carbon::parse(\request()->tanggal_akhir)->toDateTimeString();
                $data['table'] = $tamu_undangan->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->paginate(3);
                return view('users.kegiatan._data_table', $data);
            }

            $data['table'] = $this->tamu_undangan->Query()->where('user_id', Auth::user()->id)->with('kegiatan')->latest()->paginate(10);
            return view('users.kegiatan._data_table', $data);
        }

        $data['title'] = "Data kegiatan";
        return view('users.kegiatan.index', $data);
    }

    public function show(Request $request, $id)
    {
        $kegiatan = $this->kegiatan->find($id);

        if(!$kegiatan) {
            return abort(404);
        }

        $tanggal_mulai = Carbon::parse($kegiatan->tanggal_mulai);
        $tanggal_akhir = Carbon::parse($kegiatan->tanggal_akhir);
        $current_time = Carbon::now();

        if ($current_time->greaterThanOrEqualTo($tanggal_mulai) && $current_time->lessThanOrEqualTo($tanggal_akhir)) {
            $qrCode = QrCode::size(200)
            ->format('png')
            ->merge('/storage/app/public/logo/logo-tuba.png')
            ->errorCorrection('M')
            ->generate(Auth::user()->id);

            // Convert to data URI
            $data['qr'] = 'data:image/png;base64,' . base64_encode($qrCode);
            $data['title'] = "Kegiatan";
            $data['kegiatan'] = $this->kegiatan->find($id);
            $data['kegiatan_id'] = $id;
            return view('users.kegiatan.show', $data);
        } elseif ($current_time->greaterThan($tanggal_akhir)) {
          return view('pages.warning', [
            'id_halaman'    => 'kegiatan',
            'title'         => "Kegiatan ini sudah berakhir!",
            'nama_kegiatan' => $kegiatan->nama_kegiatan,
            'tanggal_mulai' => $kegiatan->tanggal_mulai,
            'tanggal_akhir' => $kegiatan->tanggal_akhir,
          ]);
        } else {
            return view('pages.warning', [
                'id_halaman'    => 'kegiatan',
                'title'         => "Kegiatan ini belum dimulai",
                'nama_kegiatan' => $kegiatan->nama_kegiatan,
                'tanggal_mulai' => $kegiatan->tanggal_mulai,
                'tanggal_akhir' => $kegiatan->tanggal_akhir,
            ]);
        }
    }

    public function store(Request $request, $id)
    {
        $idKegiatan = $this->kegiatan->find($id);
        if(!$idKegiatan) {
            return $this->error('ID Kegiatan tidak valid!');
        }

        $cekUser = $this->tamu_undangan->Query()->where('kegiatan_id', $id)->where('user_id', Auth::user()->id)->first();
        if($cekUser) {
            return $this->error("Anda sudah mengisi daftar hadir!");
        }

        if($request->ajax()) {
            $folderPath = 'public/ttdqrcode/' . date('Y') . '/';
            try {
                // Memastikan bahwa tanda tangan dikirim dan dalam format yang diharapkan
                if (isset($request->tandatangan) && strpos($request->tandatangan, ';base64,') !== false) {
                    $image_parts = explode(";base64,", $request->tandatangan);
                    $image_type_aux = explode("image/", $image_parts[0]);

                    // Memastikan format tipe gambar benar
                    if (isset($image_type_aux[1])) {
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);

                        // Menyimpan file dengan nama unik
                        $fileName = uniqid() . '.' . $image_type;
                        $file = $folderPath . $fileName;
                        Storage::put($file, $image_base64);
                    } else {
                        return $this->error('Format gambar tidak valid');
                    }
                } else {
                    return $this->error('Tanda tangan tidak valid'); 
                }
            } catch (\Exception $e) {
                // Penanganan error jika terjadi kesalahan saat menyimpan file
                return $this->error('Terjadi kesalahan saat menyimpan tanda tangan');
            }

            $data['kegiatan_id'] = $id;
            $data['user_id'] = Auth::user()->id;
            $data['opd_id'] = Auth::user()->opd->id;
            $data['tandatangan'] = $fileName;

            try {
                $this->tamu_undangan->store($data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }

            return $this->success("ok", "Anda berhasil mengisi daftar hadir");
        }
    }
}
