<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $fillable = [
        'opd_id',
        'user_id',
        'approval_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'approval_id');
    }

    public function latestStatus(): HasOne
    {
        return $this->hasOne(Status::class)->latestOfMany('created_at');
    }
    
}
