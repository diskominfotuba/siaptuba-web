<?php

namespace App\Http\Controllers\Oprator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\KegiatanService;
use App\Services\TamuService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class KegiatanController extends Controller
{
    protected $kegiatan;
    protected $tamu_undangan;
    public function __construct(KegiatanService $kegiatanservice, TamuService $tamuService) 
    {
        $this->kegiatan = $kegiatanservice;
        $this->tamu_undangan = $tamuService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
           $data['table'] = $this->kegiatan->Query()->where('opd_id', Auth::user()->opd->id)->latest()->paginate();
           return view('oprator.kegiatan._data_table', $data);
        }

        $data['title'] = "Kegiatan";
        return view('oprator.kegiatan.index', $data);  
    }

    public function create()
    {
        $data['title'] = "Tambah kegiatan baru";
        return view('oprator.kegiatan.create', $data);
    }

    public function store(Request $request) 
    {
        // Validasi input yang diterima
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'tanggal_akhir' => 'required|date',
            'jam_akhir' => 'required|date_format:H:i',
        ]);

        // Jika validasi gagal, kembalikan respons error
        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        // Ambil data yang telah divalidasi
        $data = $validator->validated();

        // Gabungkan tanggal dan waktu untuk `tanggal_mulai` dan `tanggal_akhir`
        $data['tanggal_mulai'] = $data['tanggal_mulai'] . ' ' . $data['jam_mulai'] . ':00';
        $data['tanggal_akhir'] = $data['tanggal_akhir'] . ' ' . $data['jam_akhir'] . ':00';

        // Hapus `jam_mulai` dan `jam_akhir` dari array data karena tidak diperlukan lagi
        unset($data['jam_mulai'], $data['jam_akhir']);

        // Tambahkan `opd_id` dari pengguna yang sedang login
        $data['opd_id'] = Auth::user()->opd->id;

        try {
            // Simpan data kegiatan menggunakan model atau repository
            $this->kegiatan->store($data);
        } catch (\Throwable $th) {
            // Tangani error yang mungkin terjadi selama penyimpanan data
            return $this->error($th->getMessage());
        }

        // Kembalikan respons sukses jika penyimpanan berhasil
        return $this->success('Oke', 'Kegiatan berhasil dibuat');
    }

    public function show($id)
    {
        $qrCode = QrCode::size(512)
        ->format('png')
        ->merge('/storage/app/public/logo/logo-tuba.png')
        ->errorCorrection('M')
        ->generate('/user/scan/kegiatan/result/' . $id);

        // Convert to data URI
        $data['qr'] = 'data:image/png;base64,' . base64_encode($qrCode);
        $data['kegiatan'] = $this->kegiatan->find($id);

        $data['title'] = "QRCode Kegiatan";
        return view('oprator.kegiatan.show', $data);
    }

    public function update(Request $request, $id) 
    {
           // Validasi input yang diterima
           $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'tanggal_akhir' => 'required|date',
            'jam_akhir' => 'required|date_format:H:i',
        ]);

        // Jika validasi gagal, kembalikan respons error
        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        // Ambil data yang telah divalidasi
        $data = $validator->validated();

        // Gabungkan tanggal dan waktu untuk `tanggal_mulai` dan `tanggal_akhir`
        $data['tanggal_mulai'] = $data['tanggal_mulai'] . ' ' . $data['jam_mulai'] . ':00';
        $data['tanggal_akhir'] = $data['tanggal_akhir'] . ' ' . $data['jam_akhir'] . ':00';

        // Hapus `jam_mulai` dan `jam_akhir` dari array data karena tidak diperlukan lagi
        unset($data['jam_mulai'], $data['jam_akhir']);

        // Tambahkan `opd_id` dari pengguna yang sedang login
        $data['opd_id'] = Auth::user()->opd->id;

        try {
            // Simpan data kegiatan menggunakan model atau repository
            $this->kegiatan->update($id, $data);
        } catch (\Throwable $th) {
            // Tangani error yang mungkin terjadi selama penyimpanan data
            return $this->error($th->getMessage());
        }

        // Kembalikan respons sukses jika penyimpanan berhasil
        return $this->success('Oke', 'Kegiatan berhasil diperbaharui');
    }

    public function list(Request $request, $id)
    {
        if($request->ajax()) {
            if (\request()->tanggal_awal && \request()->tanggal_akhir) {
                $tamu_undangan = $this->tamu_undangan->Query();
                $tgl_awal = Carbon::parse(\request()->tanggal_awal)->toDateTimeString();
                $tgl_akhir = Carbon::parse(\request()->tanggal_akhir)->toDateTimeString();
                $data['table'] = $tamu_undangan->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->where('kegiatan_id', $id)->paginate(3);
                return view('oprator.kegiatan._data_undangan', $data);
            }

            $data['table'] = $this->tamu_undangan->Query()->where('kegiatan_id', $id)->paginate();
            $data['opd'] = $request->opd;
            return view('oprator.kegiatan._data_undangan', $data);
        }

        $data['title'] = "Tamu undangan";
        $data['idKegiatan'] = $id;
        return view('oprator.kegiatan.tamu_udangan', $data);
    }

    public function print(Request $request, $id)
    {
        $data['title'] = "Daftar hadir";
        $data['kegiatan'] = $this->kegiatan->Query()->where('opd_id', Auth::user()->opd->id)->where('id', $id)->first();
        $data['table'] = $this->tamu_undangan->Query()->where('kegiatan_id', $id)->get();
        $data['opd'] = $request->opd;
        return view('oprator.kegiatan.print', $data);
    }

    public function printQr(Request $reques, $id)
    {
        $data['title']  = "Cetak QRCode";
        $qrCode = QrCode::size(512)
        ->format('png')
        ->merge('/storage/app/public/logo/logo-tuba.png')
        ->errorCorrection('M')
        ->generate('/user/scan/kegiatan/result/' . $id);

        // Convert to data URI
        $data['qr'] = 'data:image/png;base64,' . base64_encode($qrCode);
        $data['kegiatan'] = $this->kegiatan->find($id);
        $data['t'] = 100;
        $data['w'] = 100;
        return view('oprator.kegiatan.print_qr', $data);
    }
}
