<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamuUndangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kegiatan_id',
        'opd_id',
        'user_id',
        'tandatangan'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
