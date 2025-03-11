<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\FcmToken;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('form-submission-success', function() {
    try {
        // set cookie disini
        setcookie('submission_status', 'success', time() + 60);
        return response()->json(['status' => 'success', 'message' => 'Form submission recviedd']);
    } catch (\Exception $e) {
        Log::error('Form submission failed: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => 'Form submission failed'], 500);
    }
});

//route user
Route::get('/user', [Services\API\UserController::class, 'index']);
Route::get('/user/{user_id}', [Services\API\UserController::class, 'find']);

//route for get feed instagram
Route::get('/instagram-kominfo', [Services\API\FeedInstagramController::class, 'index']);
Route::get('/instagram-kominfo/show/{id}', [Services\API\FeedInstagramController::class, 'show']);

Route::post('/save-token', function(Request $request) {
    try {
        $fcmToken = new FcmToken();
        $fcmToken->token = $request->input('token');
        $fcmToken->save();
        return response()->json(['status' => 'success', 'message' => 'FCM token saved']);
    } catch (\Exception $e) {
        Log::error('Failed to save FCM token: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => 'Failed to save FCM token'], 500);
    }
});

//jadwal sholat
Route::get('/v2/jadwal-sholat', API\JadwalsholatController::class);