<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\BkppService;
use App\Models\BkppKomentar;

class KomentarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $komentar;
    public function __construct(BkppKomentar $komentar) {
        $this->komentar = new BkppService($komentar);
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'   => 'required',
            'pengajuan_id'  => 'required',
            'komentar'  => 'required'
        ]);

        if($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = $validator->validated();

        try {
           $this->komentar->store($data);
        } catch (\Throwable $th) {
           return $this->error($th->getMessage());
        }

        return $this->success('OK', "Alasan penolakan berhasil terkirim");
    }
}
