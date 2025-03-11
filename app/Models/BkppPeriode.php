<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkppPeriode extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_periode',
        'mulai',
        'berakhir',
        'layanan_id'
    ];

    public function layanan()
    {
        return $this->belongsTo(BkppLayanan::class, 'layanan_id', 'id');
    }
}
