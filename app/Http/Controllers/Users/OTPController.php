<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OTPController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if($request->ajax())
        {
            $response = Http::get('https://tulangbawangkab.go.id/api/v1/otp?email='. Auth()->user()->email);
            if ($response->successful()) {
                $data = $response->json();
                $data['data'] = $data['metadata'];
                return view('users.otp._data_otp', $data);
            } else {
                return view('users.otp._not_found');
            }
        }
        
        $data['title'] = 'One Time Password (OTP)';
        return view('users.otp.index', $data);
    }
}
