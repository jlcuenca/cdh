<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'title',
        'excerpt',
        'hours_duration',
        'minutes_duration',
        'duration',
        'thumbnail_url',
        'video_url',
        'video_source',
        'score',
        'is_active',
    ];

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function trainer()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'lesson_likes', 'lesson_id', 'user_id');
    }

    public function progress()
    {
        return $this->hasMany(UserLessonProgress::class, 'lesson_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(LessonComment::class);
    }

    public function materials()
    {
        return $this->hasMany(LessonMaterial::class);
    }
}
