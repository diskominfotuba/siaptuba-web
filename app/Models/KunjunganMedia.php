<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganMedia extends Model
{
    use HasFactory;
    protected $fillable = ['media_id', 'kegiatan_id', 'tandatangan'];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
    
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

}
