<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\KunjunganMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KunjunganController extends Controller
{
    public function store(Request $request, $id)
    {
        $idKegiatan = Kegiatan::find($id);
        if(!$idKegiatan) {
            return $this->warning('ID Kegiatan tidak valid!');
        }

        $cekUser = KunjunganMedia::where('kegiatan_id', $id)->where('media_id', Auth::guard('media')->user()->id)->first();
        if($cekUser) {
            return $this->warning("Anda sudah mengisi daftar hadir!");
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

            $data['media_id'] = Auth::guard('media')->user()->id;
            $data['kegiatan_id'] = $id;
            $data['tandatangan'] = $fileName;

            try {
                KunjunganMedia::create($data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }

            return $this->success("ok", "Anda berhasil mengisi daftar hadir");
        }
    }
}
