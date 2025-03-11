<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RagisterfaceController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $file = $request->face;
        $folderPath = "public/users/img/face";

        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);

        // Memastikan format tipe gambar benar
        if (isset($image_type_aux[1])) {
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Menyimpan file dengan nama unik
            $fileName = uniqid() . '.jpeg';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);
            $photo_profile = $fileName;
        } else {
            return $this->error('Format gambar tidak valid');
        }

        try {
            $user->update([
                'photo' => $photo_profile,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage());
        }
        return $this->success("OK", "Photo wajah berhasil terdaftar");
    }
}
