<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'image_url',
        'is_active',
    ];

    protected $appends = [
        'hours_minutes',
        'hours_minutes_list',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function duration()
    {
        return $this->lessons()->where('is_active', true)->sum(DB::raw("TIME_TO_SEC(duration)"));
    }

    public function getHoursMinutesAttribute()
    {
        $duration = $this->lessons()->where('is_active', true)->sum(DB::raw("TIME_TO_SEC(duration)"));
        $hh = str_pad(floor($duration / 3600), '2', '0',STR_PAD_LEFT);
        $mm = str_pad(floor($duration / 60 % 60), '2', '0', STR_PAD_LEFT);

        return "{$hh} h {$mm} min";
    }

    public function getHoursMinutesListAttribute()
    {
        $duration = $this->lessons()->where('is_active', true)->sum(DB::raw("TIME_TO_SEC(duration)"));
        $hh = floor($duration / 3600);
        $mm = floor($duration / 60 % 60);

        return ['hh' => $hh, 'mm' => $mm];
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'users_courses',
            'course_id',
            'user_id'
        );
    }

    public function progress()
    {
        return $this->hasMany(UserLessonProgress::class, 'course_id', 'id');
    }

    public function likes()
    {
        return $this->hasManyThrough(
            LessonLike::class,
            Lesson::class,
        );
        //$this->lessons()->where('is_active', true)->sum('likes')
    }

}
