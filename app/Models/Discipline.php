<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'name',
        'main_image',
        'secondary_image',
        'is_active'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'discipline_id', 'id');
    }
}
