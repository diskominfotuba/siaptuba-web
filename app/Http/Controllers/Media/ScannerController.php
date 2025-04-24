<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\KunjunganMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;

class ScannerController extends Controller
{
    public function index() {
        $data['title'] = "Scanner";
        return view('media.scanner.index', $data);
    }

    public function show(Request $request, $id)
    {
        $kegiatan = Kegiatan::find($id);

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
            ->generate(Auth::guard('media')->user()->id);

            // Convert to data URI
            $data['qr'] = 'data:image/png;base64,' . base64_encode($qrCode);
            $data['title'] = "Kegiatan";
            $data['kegiatan'] = Kegiatan::find($id);
            $data['kegiatan_id'] = $id;
            return view('media.scanner.show', $data);
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
}
