<?php

namespace App\Http\Controllers\Services\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $filename)
    {
        $pathFile = 'dokumen_kepegawaian/' . Auth::id();
        $pdf = Dokumen::where('id', '57ad06b6-eabe-49fb-98f9-a589c1081a4b')->firstOrFail();

        if (!Storage::exists($pathFile . '/' . $pdf->file)) {
            abort(404, 'File tidak ditemukan!');
        }

        $url =  $pathFile . '/' . $pdf->file;

        $urlKembali = '/';
        return view('services.kepegawaian.pdfview.index', compact('url','urlKembali'));
    }
}
