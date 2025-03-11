<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            // Cari user di tabel User
            $result = User::where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nip', $request->search)
                ->select('id', 'nama', 'nip')
                ->get();
        
            // Jika hasil pencarian di User kosong, cari di Profile
            if ($result->isEmpty()) {
                $result = Profile::where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nip', $request->search)
                    ->select('id', 'nama', 'nip')
                    ->get();
            }
        
            // Kembalikan response berdasarkan hasil
            return $this->success($result);
        }
    }
}
