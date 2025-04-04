<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

            $usergoogle = Socialite::driver('google')->user();

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

            return back()->with('error', "Akun email tidak terdaftar!");
        }
    }
}

