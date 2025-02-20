<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersCourses extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'started_at',
        'completed_at',
        'completed',
    ];

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

}
