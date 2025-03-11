<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BkppPengajuan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'layanan_id',
        'periode_id',
        'status',
        'pesan',
        'file'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function layanan()
    {
        return $this->belongsTo(BkppLayanan::class, 'layanan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function berkas()
    {
        return $this->hasMany(BkppBerkasPengajuan::class, 'pengajuan_id', 'id');
    }
}
