<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\UsersCourses;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function update(Request $request, Lesson $lesson)
    {
        $this->validate($request, [
            'seconds' => 'required',
            'percent' => 'required',
        ]);

        $user = $request->user();
        $percent = $request->get('percent');

        $learning = UsersCourses::firstOrCreate([
            'user_id' => $user->id,
            'course_id' => $lesson->course_id,
        ], [
            'started_at' => now()->format('Y-m-d H:i:s')
        ]);

        $progress = $user->progress()->updateOrCreate([
            'user_id' => $user->id,
            'course_id' => $lesson->course_id,
            'lesson_id' => $lesson->id,
        ], [
            'seconds' => round($request->get('seconds')),
            'percent' => $request->get('percent')
        ]);

        if (!$progress->completed && $percent === 1) {
            $progress->completed = true;
            $progress->save();

            $course = $lesson->course;
            $lessons_count = $course->lessons()->count();
            $progress_lessons = $user->progress()->where('course_id', $lesson->course_id)->count();

            if ($lessons_count === $progress_lessons) {
                $learning->completed_at = now()->format('Y-m-d H:i:s');
                $learning->completed = true;
                $learning->save();
            }

            $user->increment('score', $lesson->score);
        }

        return response()->json([
            'data' => $progress,
        ]);
    }
}
