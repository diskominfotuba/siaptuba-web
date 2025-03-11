<?php

namespace App\Http\Controllers\Koran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KoranController extends Controller
{
    public function index()
    {
        $data['title'] = "Ruang baca koran digital";
        return view('koran.index', $data);
    }
}
