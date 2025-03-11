<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMutasiDalamRequest extends FormRequest
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
            'rekomendasi_persetujuan_pindah__satker_asal' => $dokumen && $dokumen->rekomendasi_persetujuan_pindah__satker_asal ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'rekomendasi_persetujuan_satker_tujuan' => $dokumen && $dokumen->rekomendasi_persetujuan_satker_tujuan ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'rekomendasi_persetujuan_guru_tenaga_kesehatan' => $dokumen && $dokumen->rekomendasi_persetujuan_guru_tenaga_kesehatan ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'permohonan_pindah' => $dokumen && $dokumen->permohonan_pindah ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'fc_karpeg_legalisir' => $dokumen && $dokumen->fc_karpeg_legalisir ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'penilaian_prestasi' => $dokumen && $dokumen->penilaian_prestasi ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
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
