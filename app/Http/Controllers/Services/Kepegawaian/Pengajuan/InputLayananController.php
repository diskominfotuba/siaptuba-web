<?php

namespace App\Http\Controllers\Services\Kepegawaian\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\BkppInputLayanan;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InputLayananController extends Controller
{
    public $input;
    public function __construct(BkppInputLayanan $bkppInputLayanan)
    {
        $this->input = new BaseService($bkppInputLayanan);
    }

    public function index(Request $request) {
        return $request->all();

        $validator = Validator::make($request->all(), [
            'dokument_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = $request->except('_token');
        try {
            $this->input->store($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success('OK', 'Data berhasil ditambahkan');
    }
}
