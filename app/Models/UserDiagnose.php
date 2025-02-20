<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiagnose extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'diagnose_id',
        'needs_attention'
    ];

    protected $appends = [
        'created_at_human'
    ];

    public function diagnose()
    {
        return $this->hasOne(Diagnose::class, 'id', 'diagnose_id');
    }

    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

}
