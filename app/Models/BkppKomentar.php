<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkppKomentar extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'pengajuan_id',
        'komentar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
