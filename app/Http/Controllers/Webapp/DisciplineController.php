<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DisciplineController extends Controller
{
    public function index(Request $request)
    {
        $records = Discipline::whereNull('area_id')->get();
        $title = 'Capacitación';
        $category = 'training';

        return Inertia::render(
            'Webapp/Disciplines/Index',
            compact('records', 'title', 'category')
        );
    }

    public function show(Request $request, Discipline $discipline)
    {
        $user = $request->user();
        $title = "$discipline->name";
        $category = 'training';
        $records = $discipline->courses()->where([
            'is_active' => true,
            'category' => 'training',
        ])->with([
            'progress' => function($q) use($user) {
                return $q->where('user_id', $user->id);
            }
        ])->withCount([
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

        return Inertia::render(
            'Webapp/Courses/IndexTwo',
            compact('discipline', 'title', 'records', 'category')
        );
    }
}
