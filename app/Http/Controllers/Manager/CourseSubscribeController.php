<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UsersCourses;
use Illuminate\Http\Request;

class CourseSubscribeController extends Controller
{
    public function update(Request $request, Course $course)
    {
        $user = $request->get('user');

        $registered = $course->users()->find($user);

        if (is_null($registered)) {
            UsersCourses::create([
                'user_id' => $user,
                'course_id' => $course->id,
                'started_at' => now()->format('Y-m-d H:i:s')
            ]);
        } else {
            $course->users()->detach($user);
        }

        return response()->json(null);
    }
}
