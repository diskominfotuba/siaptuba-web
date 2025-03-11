<?php

namespace App\Http\Controllers\Services\Kepegawaian\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\BkppBerkasPengajuan;
use App\Models\BkppInputLayanan;
use App\Models\BkppKategoriLayanan;
use App\Models\BkppKomentar;
use App\Models\BkppLayanan;
use App\Models\BkppPengajuan;
use App\Models\BkppPeriode;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    public $layanan;
    public $input;
    public $berkas;
    public $pengajuan;
    public $kategori_layanan;
    public $periode;
    public $komentar;
    public function __construct(BkppKomentar $bkppKomentar, BkppPeriode $bkppPeriode, BkppBerkasPengajuan $bkppBerkasPengajuan, BkppLayanan $bkppLayanan, BkppKategoriLayanan $kategori_layanan, BkppInputLayanan $bkppInputLayanan, BkppPengajuan $bkppPengajuan)
    {
        $this->layanan = new BaseService($bkppLayanan);
        $this->input = new BaseService($bkppInputLayanan);
        $this->berkas = new BaseService($bkppBerkasPengajuan);
        $this->pengajuan = new BaseService($bkppPengajuan);
        $this->kategori_layanan = new BaseService($kategori_layanan);
        $this->periode = new BaseService($bkppPeriode);
        $this->komentar = new BaseService($bkppKomentar);
    }

    public function create(Request $request, $id)
    {
        // Ambil periode berdasarkan layanan ID
        $periode = $this->periode->query()
            ->where('layanan_id', $id)
            ->orderBy('mulai', 'desc') // Urutkan berdasarkan tanggal mulai terbaru
            ->first();

        // Jika tidak ada periode, kembalikan view
        if ($periode) {
            // Ambil tanggal sekarang
            $now = now();

            // Validasi periode
            if ($periode->mulai > $now) {
                // Jika tanggal mulai lebih besar dari sekarang, redirect ke route user.kepegawaian
                return redirect()->route('services.kepegawaian')->with('error', 'Periode belum dimulai.');
            }

            if ($periode->berakhir < $now) {
                // Jika tanggal berakhir lebih kecil dari sekarang, redirect ke route user.kepegawaian
                return redirect()->route('services.kepegawaian')->with('error', 'Periode telah berakhir.');
            }
        }

        // ambil data pengajuan terakhir yang belum selesai
        $checkPengajuan = $this->pengajuan->query()
            ->where('layanan_id', $id)
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'selesai')
            ->latest()
            ->first();

        // cek apakah data pengajuan tersebut ada atau tidak
        if ($checkPengajuan) {
            return redirect()->route('services.kepegawaian')->with('error', 'Anda telah mengajukan data sebelumnya, harap selesaikan!');
        }

        $layanan = $this->layanan->find($id);
        $data = $this->input->Query()->where('layanan_id', $id)->get();
        if ($data->isEmpty()) {
            return redirect()->route('services.kepegawaian')->with('error', 'Layanan belum tersedia!');
        }
        return view('services.kepegawaian.pengajuan.layanan.create', compact('data', 'layanan'));
    }

    public function store(Request $request, $id)
    {
        $userId = Auth::id();
        $layananId = $id;

        $berkasNotRequired = $this->input->Query()
            ->where('layanan_id', $layananId)
            ->where('required', 'n')
            ->pluck('slug')
            ->toArray();

        $validator = Validator::make(
            $request->except($berkasNotRequired),
            ['*' => 'required'],
            ['required' => 'Wajib diisi.']
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $requestData = $request->all();

        $input = [];
        $inputLayananId = [];
        foreach ($requestData as $key => $value) {
            if ($key === '_token') {
                continue;
            }
            if (str_ends_with($key, '_input_layanan_id')) {
                $inputLayananId[$key] = $value;
            } else {
                $input[$key] = $value;
            }
        }

        DB::beginTransaction();

        try {
            $pengajuan = $this->pengajuan->Query()->create([
                'user_id' => $userId,
                'layanan_id' => $layananId,
                'status' => 'diajukan',
                'pesan' => null,
            ]);

            $pengajuanId = $pengajuan->id;

            foreach ($inputLayananId as $key => $inputLayananIdValue) {
                $slug = str_replace('_input_layanan_id', '', $key);
                $dokumenId = $input[$slug] ?? null;

                if ($dokumenId) {
                    $this->berkas->Query()->create([
                        'pengajuan_id' => $pengajuanId,
                        'input_layanan_id' => $inputLayananIdValue,
                        'dokumen_id' => $dokumenId,
                    ]);
                }
            }

            DB::commit();
            return $this->success('OK', "Dokumen berhasil di simpan");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $pengajuan = $this->pengajuan->query()
            ->where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$pengajuan) {
            abort(404, 'Pengajuan tidak ditemukan');
        }

        if ($request->ajax()) {
            $data['table'] = $this->komentar->query()->where('pengajuan_id', $id)->get();
            return view('services.kepegawaian.pengajuan.layanan._data_komentar', $data);
        }

        $data['input'] = $this->input->query()
            ->with(['berkas.dokumen'])
            ->where('layanan_id', $pengajuan->layanan_id)
            ->get();

        $data['pengajuan'] = $pengajuan;
        return view('services.kepegawaian.pengajuan.layanan.show', $data);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $pengajuan = $this->pengajuan->Query()->where('id', $id)->first();

        if (!$pengajuan) {
            return response()->json(['error' => 'Pengajuan tidak ditemukan.'], 404);
        }

        $layananId = $pengajuan->layanan_id;

        // Ambil data slug yang tidak wajib diisi dari database
        $berkasNotRequired = $this->input->Query()
            ->where('layanan_id', $layananId)
            ->where('required', 'n')
            ->pluck('slug')
            ->toArray();

        // Validasi input
        $validator = Validator::make(
            $request->except($berkasNotRequired),
            ['*' => 'required'],
            ['required' => 'Wajib diisi.']
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $requestData = $request->all();

        // Pisahkan data input dan input_layanan_id
        $input = [];
        $inputLayananId = [];
        foreach ($requestData as $key => $value) {
            if ($key === '_token') {
                continue;
            }
            if (str_ends_with($key, '_input_layanan_id')) {
                $inputLayananId[$key] = $value;
            } else {
                $input[$key] = $value;
            }
        }

        DB::beginTransaction();

        try {
            if ($pengajuan->status === 'ditolak operator') {
                $status = 'diajukan';
            }
            $pengajuan->update([
                'status' => $status ?? 'pending',
                'pesan' => null,
            ]);

            // Update atau insert data ke tabel BkppBerkasPengajuan
            foreach ($inputLayananId as $key => $inputLayananIdValue) {
                // Ambil slug dan dokumen_id
                $slug = str_replace('_input_layanan_id', '', $key);
                $dokumenId = $input[$slug] ?? null;

                if ($dokumenId) {
                    // Periksa apakah data dengan input_layanan_id sudah ada
                    $berkas = $this->berkas->Query()
                        ->where('pengajuan_id', $pengajuan->id)
                        ->where('input_layanan_id', $inputLayananIdValue)
                        ->first();

                    if ($berkas) {
                        // Jika ada, update dokumen_id
                        $berkas->update([
                            'dokumen_id' => $dokumenId,
                        ]);
                    } else {
                        // Jika tidak ada, buat data baru
                        $this->berkas->Query()->create([
                            'pengajuan_id' => $pengajuan->id,
                            'input_layanan_id' => $inputLayananIdValue,
                            'dokumen_id' => $dokumenId,
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json(['message' => 'Pengajuan berhasil diperbarui.'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }
}
