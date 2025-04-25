<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('media.profile.index');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
            'nama_media' => 'required|string|max:255',
            'alamat_kantor' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
           return $this->error($validator->errors());
        }

        $data = $validator->validated();
        Auth::guard('media')->user()->update($data);
        return $this->success($data, 'Profil berhasil diperbarui');
    }

    public function logout()
    {
        Auth::guard('media')->logout();
        return redirect('/');
    }
}
