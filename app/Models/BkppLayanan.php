<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkppLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_layanan',
        'kategori_id',
        'slug',
    ];

    public function kategori() {
        return $this->belongsTo(BkppKategoriLayanan::class, 'kategori_id', 'id');
    }

    public function input() {
        return $this->hasMany(BkppInputLayanan::class, 'layanan_id', 'id');
     }

     public function pengajuan() {
        return $this->hasMany(BkppPengajuan::class,'layanan_id','id');
     }

    public function periode()
    {
        return $this->hasMany(BkppPeriode::class, 'layanan_id', 'id');
    }
}
