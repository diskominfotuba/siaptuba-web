<?php

namespace App\Http\Controllers\Stream;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StreamController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if ($extension !== 'pdf') {
            abort(404);
        }

        return response()->stream(function () use ($filename) {
            $stream = Storage::disk('s3')->readStream(str_replace('|', '/', $filename));
            while (!feof($stream)) {
                echo fread($stream, 1024 * 8); // Membaca file dalam blok 8 KB
            }
            fclose($stream);
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}
