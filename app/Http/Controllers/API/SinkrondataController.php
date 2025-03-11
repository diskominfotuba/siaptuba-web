<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class SinkrondataController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $user = Auth::user();
        $url = env('SSO') . '/user/login';
        $response = Http::withHeaders([
            'App'          => 'siaptuba',
            'Content-Type' => 'application/json',
        ])->post($url, [
            'email'     => $user->email,
            'password'  => $user->password,
        ]);
        $token = $response->json()['data'];
        Cache::put('akses_token_'.$user->id, $token, now()->addDays(90));
        return $this->success($token);
    }

    public function sinkronisasi()
    {
        $user = Auth::user();
        $url = env('SSO') . '/user/sinkornisasi';
        $token = Cache::get('akses_token_'.$user->id);

        // Jika token tidak ada, kirim respon error
        if (!$token) {
            return $this->warning('Token akses tidak ditemukan atau sudah kadaluarsa', 401);
        }

        // Kirim request ke API SSO
        try {
            $response = Http::withToken($token)->post($url, [
                'opd_id'    => $user->opd_id,
                'user_id'   => $user->id,
                'nip'       => $user->nip,
                'tpp'       => $user->tpp,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->warning('Internal service error!');
        }

        // Periksa jika request gagal
        if ($response->failed()) {
            return $this->warning($response->json()['errors']);
        }
        
        // Jika sukses, kirimkan respons ke user
        $result = $response->json()['data'];
        $user = User::find($user->id);
        $user->update([
            'nip'       => $result['nip_baru'],
            'nama'      => $result['gelar_depan'] . ' ' . $result['nama'] . ' ' . $result['gelar_belakang'],
            'jabatan'   => $result['jabatan_nama'],
            'opd_nama'  => $result['unor_nama'],
            'no_hp'     => $result['nomor_hp'],
            'status_sinkronisasi'    => 'Y'
        ]);
        return $this->success($response->json(), 'Data berhasil di sinkronkan');
    }
}
