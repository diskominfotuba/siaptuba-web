<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkppKatpengajuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_bidang',
        'nama_kategori',
        'slug'
    ];
}
