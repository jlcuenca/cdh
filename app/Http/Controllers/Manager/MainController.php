<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index()
    {
        $courses = Course::select('title')->withCount('users')->where('is_active', true)->orderBy('users_count', 'desc')->get();
        $coursesCount = $courses->count();
        $topTenCourses = $courses->where('users_count', '>', 0)->take(10);

        $users = User::select('name')->where('is_student', true)->withCount([
            'courses',
            'courses as courses_completed_count' => function($q) {
                return $q->where('completed', true);
            },
            'courses as courses_in_progress_count' => function($q) {
                return $q->where('completed', false);
            }
        ])->orderBy('courses_count', 'desc')->get();

        $usersCount = number_format($users->count(), 0);
        $topTenUsers = $users->where('courses_count', '>', 0)->take(10);
        $usersWithCoursesCompletedCount = number_format($users->sum('courses_completed_count'), 0);
        $usersWithCoursesInProgressCount = number_format($users->sum('courses_in_progress_count'), 0);

        return Inertia::render('Admin/Dashboard', compact(
            'coursesCount',
            'topTenCourses',
            'usersCount',
            'usersWithCoursesCompletedCount',
            'usersWithCoursesInProgressCount',
            'topTenUsers',
        ));
    }
}
