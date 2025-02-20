<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $courses = Course::where('is_active', true)
            ->withCount([
                'lessons' => function($q) {
                    return $q->where('is_active', true);
                },
                'likes',
                'progress' => function($q) use($user) {
                    return $q->where('user_id', $user->id);
                },
                'progress as lessons_completed_count' => function($q) use($user) {
                    return $q->where([
                        'user_id' => $user->id,
                        'completed' => true
                    ]);
                }
            ])
            ->paginate(10);
        $pagination = (string) $courses->onEachSide(1)->links();

        $records = $user->courses()->whereHas('progress', function($q) use($user) {
            return $q->where('user_id', $user->id);
        })->with('progress')->withCount([
            'lessons' => function($q) {
                return $q->where('is_active', true);
            },
            'likes',
            'progress' => function($q) use($user) {
                return $q->where('user_id', $user->id);
            },
            'progress as lessons_completed_count' => function($q) use($user) {
                return $q->where([
                    'user_id' => $user->id,
                    'completed' => true
                ]);
            }
        ])->get();

        return Inertia::render('Webapp/Main', compact('records', 'courses', 'pagination'));
    }

    public function awards()
    {
        $user = auth()->user();

        return Inertia::render('Webapp/Award/Index', [
            'score' => $user->score,
            'lessonsCount' => $user->progress()->count(),
            'time' => $user->time_lapsed
        ]);
    }

}
