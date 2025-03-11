<?php

namespace App\Http\Controllers\Services\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Models\User;

class UserController extends Controller
{
    public $user;
    public function __construct(User $user)
    {
        $this->user = new BaseService($user);
    }
    public function index(Request $request)
    {
        $user = $this->user->Query()->where('nama', 'like', '%' . $request->search . '%')->select('id','nama', 'email')->get();
        if($user) {
            return \response()->json([
                'success'   => true,
                'message'   => "List data user",
                'data'      => $user,
            ], 200);
        }else {
            return $this->success('oke', 'user tidak ditemukan');
        }
    }

    public function find($user_id) 
    {
        $user = $this->user->find($user_id);
        $data = [
            'name'  => $user->nama,
            'email' => $user->email,
            'password'  => $user->password,
            'avatar'    => $user->photo
        ];

        if($user) {
            return \response()->json([
                'success'   => true,
                'message'   => "Data user",
                'data'      => $data,
            ], 200);
        }else {
            return $this->success('oke', 'user tidak ditemukan');
        }
    }
}
