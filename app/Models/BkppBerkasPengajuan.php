<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BkppBerkasPengajuan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pengajuan_id',
        'input_layanan_id',
        'dokumen_id',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function pengajuan()
    {
        return $this->belongsTo(BkppPengajuan::class);
    }

    public function input()
    {
        return $this->belongsTo(BkppInputLayanan::class, 'input_layanan_id', 'id');
    }


    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'dokumen_id', 'id');
    }
}
