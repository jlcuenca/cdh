<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_manager',
        'is_teacher',
        'is_student',
        'is_active',
        'firstname',
        'paternal_lastname',
        'maternal_lastname',
        'gender',
        'state_name',
        'city_name',
        'address',
        'date_of_birth',
        'postal_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ownCompany()
    {
        return $this->hasOne(Company::class, 'user_id', 'id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_users', 'user_id', 'company_id');
    }

    /**
     *
     * Couch / Trainer
     **/

    public function instructing()
    {
        return $this->hasMany(Course::class, 'user_id', 'id');
    }

    /**
     *
     * Student
     **/

    public function evaluations()
    {
        return $this->hasMany(UserDiagnose::class, 'user_id', 'id');
    }

    public function evaluationAnswers()
    {
        return $this->hasMany(UserDiagnoseAnswer::class, 'user_id', 'id');
    }

    public function progress()
    {
        return $this->hasMany(UserLessonProgress::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_likes', 'user_id', 'lesson_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'users_courses', 'user_id', 'course_id');
    }

    public function coursesMeta()
    {
        return $this->hasMany(UsersCourses::class, 'user_id', 'id');
    }

    public function getTimeLapsedAttribute()
    {
        $duration = $this->progress()->sum(DB::raw("TIME_TO_SEC(seconds)"));
        $hh = str_pad(floor($duration / 3600), '2', '0',STR_PAD_LEFT);
        $mm = str_pad(floor($duration / 60 % 60), '2', '0', STR_PAD_LEFT);

        return "{$hh} h {$mm} min";
    }
}
