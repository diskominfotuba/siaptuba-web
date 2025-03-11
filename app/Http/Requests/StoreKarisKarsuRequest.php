<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreKarisKarsuRequest extends FormRequest
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
            'surat_pengangar_satker_cq_kepala_bkpp' => $dokumen && $dokumen->surat_pengangar_satker_cq_kepala_bkpp ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'blanko' => $dokumen && $dokumen->blanko ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'fc_buku_akta_nikah_legalisir' => $dokumen && $dokumen->fc_buku_akta_nikah_legalisir ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'foto_suami_atau_istri' => $dokumen && $dokumen->foto_suami_atau_istri ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
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
