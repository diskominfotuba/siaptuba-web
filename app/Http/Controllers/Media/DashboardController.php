<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\KunjunganMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $media = Auth::guard('media')->user();
        if($request->ajax()) {
            $data['table'] = KunjunganMedia::where('media_id', $media->id)->with('kegiatan')->latest()->paginate(10);
            return  view('media.dashboard._data_kunjungan', $data);
        }
        return view('media.dashboard.index');
    }
}
