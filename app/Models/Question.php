<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnose_section_id',
        'diagnose_id',
        'title',
        'description',
    ];

    protected $appends = [
        'answers_type'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserDiagnoseAnswer::class, 'question_id', 'id');
    }

    public function getAnswersTypeAttribute()
    {
        $count = $this->answers()->count();
        return $count === 0 ? '' : ((in_array($this->answers()->first()->value, ['yes', 'no'])) ? 'true_false' : 'group_of_data');
    }
}
