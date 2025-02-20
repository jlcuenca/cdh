<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessonProgress extends Model
{
    use HasFactory;

    protected $table = 'user_lessons_progress';

    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'seconds',
        'percent',
        'completed',
    ];
}
