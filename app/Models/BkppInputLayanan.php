<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkppInputLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'layanan_id',
        'nama_input',
        'slug',
        'required',
    ];

    public function layanan()
    {
        return $this->belongsTo(BkppLayanan::class, 'layanan_id', 'id');
    }

    public function berkas()
    {
        return $this->hasMany(BkppBerkasPengajuan::class, 'input_layanan_id', 'id');
    }

    public function dokumen()
    {
        return $this->hasManyThrough(Dokumen::class, BkppBerkasPengajuan::class, 'input_layanan_id', 'id', 'id', 'dokumen_id');
    }
}
