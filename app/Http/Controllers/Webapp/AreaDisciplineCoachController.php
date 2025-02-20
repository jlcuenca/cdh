<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Http\Resources\Webapp\TrainerResource;
use App\Models\Area;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AreaDisciplineCoachController extends Controller
{
    public function show(Request $request, Area $area, Discipline $discipline, User $trainer)
    {
        if (!$trainer->is_coach) {
            return abort(422);
        }

        $user = $request->user();

        $records = $trainer->instructing()->where([
            'area_id' => $area->id,
            'discipline_id' => $discipline->id,
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


        $trainer = new TrainerResource($trainer);

        return Inertia::render(
            'Webapp/Trainers/Courses',
            compact('trainer', 'records', 'area', 'discipline')
        );
    }
}
