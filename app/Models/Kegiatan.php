<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Kegiatan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'opd_id',
        'nama_kegiatan',
        'deskripsi_kegiatan',
        'tanggal_mulai',
        'tanggal_akhir',
        'latlong'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
