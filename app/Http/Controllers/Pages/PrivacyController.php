<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('privasi.index');
    }
}
