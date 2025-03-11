<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Logfacecheck;
class FacecheckController extends Controller
{
    public function __invoke(Request $request)
    {

        $except = ['oktavianuspetrac@gmail.com', 'femilia.wn02@gmail.com', 'jprandika@gmail.com'];

        // Dapatkan email dari user yang sedang login
        $userEmail = Auth::user()->email;

        // Periksa apakah email user ada dalam array $except
        if (in_array($userEmail, $except)) {
            return response()->json([
                'message' => 'suceess',
                'data'    => null,
                'success' => true,
            ], 200);
        } 
     
        $img =  $request->image;
        $folderPath = "storage/users/img/face";

        // Decode base64 string
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Generate a unique filename
        $fileName = uniqid() . '.jpg';
        $file = $folderPath . $fileName;

        // Save the decoded base64 string as an image file
        file_put_contents($file, $image_base64);

        // Use Http::attach to attach the image file
        // http://localhost:3333/api/check
        $response = Http::attach(
            'face', file_get_contents($file), $fileName, ['Content-Type' => 'image/jpeg']
        )->put(config('app.api_face') .'/check', [
            'userId' => Auth::user()->id,
        ]);

        // Handle response
        if ($response->successful()) {
            $responseData = json_decode($response->body(), true);
            if($responseData['message'] == "Wajah tidak cocok") {
                telegramNotification('Face check', 'Wajah tidak cocok!');
                Logfacecheck::create([
                    'user_id'   => Auth::user()->id,
                    'log_type'  => $responseData['message'],
                    'face'      => $file
                ]);
            }

             // Delete the temporary file after sending
            // unlink($file);
            return response()->json([
                'message' => 'suceess',
                'data'    => $response->body(),
                'success' => true,
            ], 200);
        }else {
             // Delete the temporary file after sending
            // unlink($file);
            telegramNotification('Internal Server Error', 'API Face check error!');
            return response()->json([
                "sucess"    => false,
                "message"   => "Internal Server Error!",
            ]);
        }
 
    }
}
