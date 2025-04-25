<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Media;

class PasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'password_baru' => 'required|string',
        ]);

        if($validator->fails()) {
            return $this->error($validator->errors());
         }
        $data = $validator->validated();

        $media = Media::where('token', $data['password'])->where('email',  Auth::guard('media')->user()->email)->first();
        if (!$media) {
            return $this->warning('Password lama tidak sesuai', 400);
        }

        $media->token =$data['password_baru'];
        $media->save();
        return $this->success($data, 'Password berhasil diperbarui');
    }
}
 