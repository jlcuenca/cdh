<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'is_active'
    ];

    public function sections()
    {
        return $this->hasMany(DiagnoseSection::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_diagnoses', 'diagnose_id', 'user_id');
    }
}
