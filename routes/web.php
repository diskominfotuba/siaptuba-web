<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/login', function () {
    return redirect('/');
});

//route login
Route::get('/', Users\LoginController::class)->middleware('guest')->name('login');
Route::post('/user/login', Auth\LoginController::class)->middleware('guest');

//test pdf viewer
Route::get('/pdf-viewer', function () {
    return view('pages.pdf-viewer');
});

//login google
Route::middleware('guest')->group(function () {
    Route::get('/google/login', [Auth\Authgoogle::class, 'redirect'])->name('auth-redirect');
    Route::get('/google/callback', [Auth\Authgoogle::class, 'callback'])->name('auth-callback');
});
Route::get('/user/logout', Auth\LogoutController::class)->middleware('auth');

// Route::get('/privacy-policy', PrivacyController::class);
Route::get('/notifikasi', Pages\NotifikasiController::class)->name('notifikasi');


Route::middleware(['auth', 'webview'])->prefix('user')->group(function () {
    //route for list apps
    Route::get('/apps', Users\AppContrller::class)->name('user.apps');

    //route for drive
    Route::get('/drive', [Users\DriveController::class, 'index'])->name('user.drive');

    //route page
    Route::get('/page/register-face', Users\PageController::class);

    //route for wbs
    Route::get('/wbs-inspektorat', Users\WbsController::class);

    // route for survey media
    Route::controller(Users\SurveyMediaController::class)->group(function () {
        Route::get('/survey-media', 'index')->name('user.surveymedia');
        Route::post('/survey-media/store', 'store')->name('user.surveymedia.store');
        Route::get('/survey-media/result/{category}/{month}/{year}', 'result')->name('user.surveymedia.result');
    });
    // end route for survey media

    //route untuk menampilkan PDF dalam iframe
    Route::get('/pdf-viewer/{dir}/{filename}', Pages\PDFviewerController::class)->name('pdfviewer');
});

 //route stream untuk menampilkan semua file
 Route::get('/stream/{filename}', Stream\StreamController::class)->name('stream')->middleware('auth');

// Panggil route dari modul user // routes/user.php
require __DIR__ . '/user.php';

// Panggil route dari modul operator // routes/operator.php
require __DIR__ . '/operator.php';

//panggil route dari modul admin // routes/admin.php
require __DIR__ . '/admin.php';

//panggil route dari modul kepegawaian // routes/kepegawaian.php
require __DIR__ . '/services/kepegawaian.php';

//panggil route dari modul food // routes/food.php
require __DIR__ . '/services/food.php';

//panggil route dari modul ragahtuah // routes/ragahtuah.php
require __DIR__ . '/services/ragahtuah.php';

//panggil route dari modul baznas
require __DIR__ . '/services/baznas.php';

//panggil route dari modul bkpp // routes/bkpp.php
require __DIR__ . '/bkpp.php';

//panggil route dari modul koran // routes/koran.php
require __DIR__ . '/koran.php';

//panggil route dari modul koran // routes/koran.php
require __DIR__ . '/media.php';

//panggil route modul lainnya disini

//semua route untuk mengambil asset dari folder stoarge/...
Route::middleware('auth')->group(function () {
    //route untuk menampilkan asset gambar, contoh penggunaan pada file resources/views/users/dashboard/_data_table_absensi.blade.php, line ke 4
    Route::get('disk/{year}/{filename}', function ($year, $filename) {

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        if ($extension === 'php' || $extension === 'js') {
            abort(404);
        }

        $path = storage_path('app/public/images/' . $year . '/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path);
    })->name('photo-presensi');

    //route untuk menampilkan asset gambar ekin
    Route::get('storage/{year}/{filename}', function ($year, $filename) {

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        if ($extension === 'php' || $extension === 'js') {
            abort(404);
        }

        $path = storage_path('app/public/ekin/' . $year . '/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }
        return response()->file($path);
    })->name('ekin');

    //route untuk drive
    Route::get('photo/pj/2024/{filename}', function ($filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        if ($extension === 'php' || $extension === 'js') {
            abort(404);
        }

        $path = storage_path('app/public/drive/pjbupati/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }
        return response()->file($path);
    })->name('drive');

    Route::get('/download/{filename}', function ($filename) {
        $filePath = 'drive/pjbupati/' . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    })->name('drive.download');

    //mengambil ttd qrcode kehadiran pegawai
    Route::get('/bukti-hadir/{year}/{filename}', function ($year, $filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        if ($extension === 'php' || $extension === 'js') {
            abort(404);
        }

        $path = storage_path('app/public/ttdqrcode/' . $year . '/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }
        return response()->file($path);
    })->name('ttdqrcode');

    //dokumen kepegawaian
    Route::get('/filemanager/{year}/{filename}', function ($year, $filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        if ($extension === 'php' || $extension === 'js') {
            abort(404);
        }

        $path = storage_path('app/public/dokumen/' . $year . '/' . auth()->user()->id . '/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }
        return response()->file($path);
    })->name('dokumen');
});

//dokumen kepegawaian akses operator
Route::get('/filemanager/{year}/{dir}/{filename}', function ($year, $dir, $filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    if ($extension === 'php' || $extension === 'js') {
        abort(404);
    }

    $path = storage_path('app/public/dokumen/' . $year . '/' . $dir . '/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('bkpp.dokumen');

//route dokumen untuk photo profile
Route::get('/profile/{filename}', function ($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    if ($extension === 'php' || $extension === 'js') {
        abort(404);
    }

    $path = storage_path('app/public/users/img/face' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name("photo-profile");

//file stream
// Route::get('/stream', function () {
//     $pathFile = 'dokumen_kepegawaian/' . Auth::id();
//     $pdf = Dokumen::where('id', '57ad06b6-eabe-49fb-98f9-a589c1081a4b')->firstOrFail();

//     if (!Storage::exists($pathFile . '/' . $pdf->file)) {
//         abort(404, 'File tidak ditemukan!');
//     }

//     return response()->stream(function () use ($pdf) {
//         echo Storage::get($pathFile . '/' . $pdf->file);
//     }, 200, [
//         'Content-Type' => $file->mime_type,
//         'Content-Disposition' => 'inline; filename="' . $pdf->file . '"',
//     ]);
// })->name('stream');

Route::get('/ekin/{opd}/{year}/{filename}', function ($opd, $year, $filename) {
    // Cegah akses file berbahaya
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($extension, ['jpg', 'jpeg', 'png', 'pdf'])) {
        abort(404);
    }

    // Path file di MinIO
    $path = "ekin/{$opd}/{$year}/{$filename}";

    // Periksa apakah file ada di MinIO
    if (!Storage::disk('s3')->exists($path)) {
        abort(404);
    }

    // Dapatkan MIME type
    $mimeType = Storage::disk('s3')->mimeType($path);

    // Stream file
    return response()->stream(function () use ($path) {
        $stream = Storage::disk('s3')->readStream($path);
        while (!feof($stream)) {
            echo fread($stream, 1024 * 8); // Membaca file dalam blok 8 KB
        }
        fclose($stream);
    }, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
    ]);
})->name('lampiran-ekin');
