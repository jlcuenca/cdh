<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnoseSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnose_id',
        'title',
        'excerpt'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function usersAnswers()
    {
        return $this->hasMany(UserDiagnoseAnswer::class, 'diagnose_section_id', 'id');
    }
}
