<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\SurveyMediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SurveyMediaController extends Controller
{
    public $surveyMedia;
    public function __construct(SurveyMediaService $surveyMediaService)
    {
        $this->surveyMedia = $surveyMediaService;
    }

    public function index()
    {
        if (!empty($this->surveyMedia->Query()->where('user_id', Auth::user()->id)->first())) {
            return redirect('/user/dashboard');
        }
        return view('users.survey.media.index');
    }

    public function store(Request $request)
    {
        if (!empty($this->surveyMedia->Query()->where('user_id', Auth::user()->id)->first())) {
            return redirect('/user/dashboard');
        }

        $validator = Validator::make($request->all(), [
            'status_pegawai'    => 'required',
            'media'     => 'required',
            'media.*' => 'string',
            'pernah_membaca' => 'required|string',
            'preferensi_membaca' => 'required|string',
            'sumber_berita' => 'required|string',
            'koran_digital' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        // Menyimpan data yang telah divalidasi
        $data = $validator->validated();

        $user = Auth::user();
        $data['user_id'] = $user->id;
        $data['media'] = json_encode($request->media);
        $data['media_mingguan'] = json_encode($request->mediaMingguan);

        // Menyimpan data ke database dengan handling error
        try {
            $this->surveyMedia->store($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return redirect('/user/dashboard');
    }

    public function result($category, $month, $year)
    {
        $responses = $this->surveyMedia->Query()->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();

        $mediaCounts = [];

        foreach ($responses as $response) {
            if ($category == 'mingguan') {
                $mediaArray = json_decode($response->media_mingguan, true);
            } else if ($category == 'harian') {
                $mediaArray = json_decode($response->media, true);
            } else {
                return abort(404);
            }
            foreach ($mediaArray as $media) {
                if (isset($mediaCounts[$media])) {
                    $mediaCounts[$media]++;
                } else {
                    $mediaCounts[$media] = 1;
                }
            }
        }

        return response()->json($mediaCounts);
    }
}
