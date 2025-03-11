<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tpp extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tpp_berjalan',
        'jumlah_menit',
        'pengurangan',
        'keterangan',
        'created_at'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }
}
