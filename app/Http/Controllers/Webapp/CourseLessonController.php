<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Http\Resources\Webapp\TrainerResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseLessonController extends Controller
{
    public function index(Request $request, Course $course)
    {
        $user = $request->user();
        $records = $course->lessons()->with([
            'progress' => function($q) use($user) {
                return $q->where('user_id', $user->id);
            }
        ])->withCount('likes')->where('is_active', true)->get();

        return Inertia::render('Webapp/Lessons/Index', compact('course', 'records'));
    }

    public function show(Request $request, Course $course, Lesson $lesson)
    {
        $user = $request->user();
        $prev = $course->lessons()->where('id', '<', $lesson->id)->orderBy('id', 'DESC')->first();
        $next = $course->lessons()->where('id', '>', $lesson->id)->orderBy('id', 'asc')->first();

        $liked = !is_null($user->likes()->where('lessons.id', $lesson->id)->first());

        $progress = $user->progress()->where([
            'course_id' => $lesson->course_id,
            'lesson_id' => $lesson->id,
        ])->first();

        $comments = $lesson->comments()->with('user:id,name')->orderBy('id', 'DESC')->paginate(5);
        $pagination = (string) $comments->onEachSide(1)->links();

        return Inertia::render(
            'Webapp/Lessons/Show',
            compact('course', 'course', 'lesson', 'prev', 'next', 'liked', 'progress', 'comments', 'pagination')
        );
    }
}
