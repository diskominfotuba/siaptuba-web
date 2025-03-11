<?php

namespace App\Http\Controllers\Services\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data['title'] = 'Layanan kepegawaian';
        return view('services.kepegawaian.layanan.index');
    }
}
