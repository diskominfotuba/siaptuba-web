<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMutasiMasukRequest extends FormRequest
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
            'surat_permohonan_pribadi' => $dokumen && $dokumen->surat_permohonan_pribadi ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'analisis_jabatan_dan_beban_kerja' => $dokumen && $dokumen->analisis_jabatan_dan_beban_kerja ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'surat_pernyataan_tidak_sedang_pendidikan' => $dokumen && $dokumen->surat_pernyataan_tidak_sedang_pendidikan ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'surat_pernyataan_tidak_sedang_hukuman_disiplin' => $dokumen && $dokumen->surat_pernyataan_tidak_sedang_hukuman_disiplin ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'surat_pernyataan_bebas_temuan' => $dokumen && $dokumen->surat_pernyataan_bebas_temuan ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'surat_pernyataan_mematuhi_disiplin_pns' => $dokumen && $dokumen->surat_pernyataan_mematuhi_disiplin_pns ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'fc_sk_jabatan_1_satu_tahun_terakhir' => 'mimes:pdf|max:1024',
            'penilaian_prestasi' => $dokumen && $dokumen->penilaian_prestasi ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'fc_karpeg_legalisir' => $dokumen && $dokumen->fc_karpeg_legalisir ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'daftar_riwayat_hidup' => $dokumen && $dokumen->daftar_riwayat_hidup ? 'mimes:pdf|max:1024' : 'required|mimes:pdf|max:1024',
            'fc_alihtugas_pemindahan' =>  'mimes:pdf|max:1024',
            'fc_surat_nikah' => 'mimes:pdf|max:1024',
            'fc_ktp' => 'mimes:pdf|max:1024',
            'fc_surat_keterangan_dokter' => 'mimes:pdf|max:1024',
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
