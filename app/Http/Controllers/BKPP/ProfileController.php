<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        if($request->search) {
            // $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiJhNWIxZTJiZi0wM2NhLTQzMDEtOTMxMC1hNzM2NjUzNjhmNzciLCJlbWFpbCI6ImRldmtoQGdtYWlsLmNvbSIsImlhdCI6MTc0MDEwMzAxMCwiZXhwIjoxNzQwMTA2NjEwfQ.UJYSwS22e9R_7I0j74iGIEHP9irNk1EzH9EiANmgJKs')->get(env('SSO').'/user/profile?search='.$request->search);
            $result = Profile::where('nama', 'like', '%' . $request->search . '%')
            ->orWhere('nip',$request->search)->select('nama', 'nip')->get();

            if ($result) {
               return $this->success($result);
            }else {
                return $this->error('Internal server error!');
            }
        }
    }
}
