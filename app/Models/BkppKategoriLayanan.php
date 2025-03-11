<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkppKategoriLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kategori',
        'slug',
    ];

    public function layanan()
    {
        return $this->hasMany(BkppLayanan::class, 'kategori_id', 'id');
    }
}
