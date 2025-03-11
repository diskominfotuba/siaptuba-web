<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Profile;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public $user;
    public $profile;
    public function __construct(User $user, Profile $profile)
    {
        $this->user = new BaseService($user);
        $this->profile = new BaseService($profile);
    }

    public function index()
    {
        $data['title']  = 'Profile';
        return view('users.profile.index', $data);
    }

    public function sinkronisasi(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        // validasi nip apakah ada di table profile
        $check_nip = $this->profile->Query()
            ->where('nip', $request->nip)
            ->first();

        if (!$check_nip) {
            return $this->warning('NIP tidak ditemukan pada data Kepegawaian');
        }

        if ($user_id !== null && $request->nip !== null) {
            try {
                $data['status_sinkronisasi'] = 'Y';
                $this->user->update($user, $data);
            } catch (\Throwable $e) {
                return $this->warning($e->getMessage());
            }
        } else {
            return $this->warning('Fitur ini belum tersedia');
        }
    }
}
