<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;
    protected $fillable = ['opd_id', 'nama_module', 'status'];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}

