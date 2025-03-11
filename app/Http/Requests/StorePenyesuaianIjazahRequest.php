<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePenyesuaianIjazahRequest extends FormRequest
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
            'surat_pernyataan_mempunyai_integritas' => $dokumen && $dokumen->surat_pernyataan_mempunyai_integritas ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'uraian_tugas_yang_ditandatangani' => 'mimes:pdf|max:1024',
            'fc_surat_izin_belajar' => $dokumen && $dokumen->fc_surat_izin_belajar ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'surat_tanda_lulus_ujian_dinas' => $dokumen && $dokumen->surat_tanda_lulus_ujian_dinas ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'sc_pangkalan_data_pendidikan_tinggi' => $dokumen && $dokumen->sc_pangkalan_data_pendidikan_tinggi ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'akreditasi_program_studi' => $dokumen && $dokumen->akreditasi_program_studi ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'penilaian_prestasi' => $dokumen && $dokumen->penilaian_prestasi ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'sk_penyesuaian_masa_kerja' => 'mimes:pdf|max:1024',
            'sk_mutasi_bagi_yang_pindah' => $dokumen && $dokumen->sk_mutasi_bagi_yang_pindah ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'sk_tugas_belajar' => 'mimes:pdf|max:1024',
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
