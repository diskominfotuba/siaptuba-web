<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePencantumanGelarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = Auth::user()->id;
        $dokumen = \App\Models\Dokumen::where('user_id', $userId)->first();

        return [
            'surat_pengangar_satker_cq_kepala_bkpp' => 'required',
            'sc_pangkalan_data_pendidikan_tinggi' => 'required',
            'akreditasi_program_studi' => 'required',
            'fc_sk_jabatan_struktural' => 'required',
            'fc_spp_surat_pernyataan_pelantikan' => 'required',
            'fc_surat_izin_belajar' => 'required',
            'uraian_tugas_yang_ditandatangani' => 'required',
            'penilaian_prestasi' => 'required',
            'sk_mutasi_bagi_yang_pindah' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(
            validationErrorResponse($errors)
        );
    }
}
