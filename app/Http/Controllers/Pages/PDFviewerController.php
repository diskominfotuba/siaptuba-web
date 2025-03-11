<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFviewerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $dir, $filename)
    {
        if($dir == 'berkala') {
            $dir = 'dokumen_kepegawaian|berkala|';
        }else {
            $dir = 'dokumen_kepegawaian|'. Auth::id() .'|';
        }

        $data['title']      = "PDF Viewer";
        $data['filename']   = $filename;
        $data['dir']        = $dir;
        return \view('pages.pdf-viewer', $data);
    }
}
