<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Media;

class Authgoogle extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        if (isset($_REQUEST['error']) && ($_REQUEST['error'] == 'access_denied')) {
            Auth::logout();

            return Redirect::route('login');
        } else {

            $usergoogle = Socialite::driver('google')->stateless()->user();

            $user = User::where([
                'email' => $usergoogle->email,
            ])->first();

            if($user) {
                Auth::login($user);
                return redirect('/user/dashboard');
            }

            $profile = Profile::where([
                'email' => $usergoogle->email,
            ])->first();
            
            if($profile) {
                Auth::login($user);
                return redirect('/user/dashboard');
            }

            $media = Media::where([
                'email' => $usergoogle->email,
            ])->first();
            if($media) {
                Auth::guard('media')->login($media);
                return redirect('/media/dashboard');
            }
            return back()->with('error', "Akun email tidak terdaftar!");
        }
    }
}

