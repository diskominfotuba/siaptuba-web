<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/user/dashboard');
        }

        $media = Media::where('email', $request->email)->where('token', $request->password)->first();
        if($media) {
            Auth::guard('media')->login($media);
            return redirect('/media/dashboard');
        }

        return back()->with('error', 'Email atau Password Salah!')->onlyInput('email');
    }
}
