<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriveController extends Controller
{
    public function index()
    {
        $data['title'] = "Drive SIAP TUBA";
        return view('users.drive.index', $data);
    }
}
