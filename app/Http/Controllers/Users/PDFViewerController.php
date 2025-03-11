<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PDFViewerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $year, $filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        if ($extension === 'php' || $extension === 'js') {
            abort(404);
        }
        $data['path'] =  $year . '/' . Auth::user()->id . '/' . $filename;
        $data['title'] = "PDF Viewer";
        $data['urlKembali'] = "/user/dokumen";
        return \view('pages.pdfviewer', $data);
    }
}
