<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use App\Models\BkppKomentar;
use App\Services\BkppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserKomentarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $komentar;
    public function __construct(BkppKomentar $komentar)
    {
        $this->komentar = new BkppService($komentar);
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pengajuan_id'  => 'required',
            'komentar'  => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = $validator->validated();
        $data['user_id'] = Auth::id();

        try {
            $this->komentar->store($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success('OK', "Alasan penolakan berhasil terkirim");
    }
}
