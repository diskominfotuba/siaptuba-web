<?php

namespace App\Http\Controllers\Services\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Cache;

class OTPController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Mail::to('diskominfotuba2022@gmail.com')->send(new SendMail());
        // dd('email terkirim');

        $data['otp'] = "OTP Kepegawaian";
        return view('services.kepegawaian.otp.index', $data);
    }

    public function verifOtp(Request $request)
    {
        $otp = implode("", $request->otp);
        if ($otp == "123456") {
            Cache::put('otp_kepegawaian_verified', true, now()->addHours(2));
            return redirect()->route('user.kepegawaian');
        }
        return redirect()->back()->with('error', 'OTP tidak valid');
    }
}
