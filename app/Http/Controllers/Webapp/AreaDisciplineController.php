<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AreaDisciplineController extends Controller
{
    public function index(Request $request, Area $area)
    {
        $title = "$area->name / Disciplinas";
        $records = $area->disciplines()->where('is_active', true)->get();

        return Inertia::render(
            'Webapp/Disciplines/Index',
            compact('title','area', 'records')
        );
    }

    public function show(Request $request, Area $area, Discipline $discipline)
    {
        $title = "$area->name / Disciplinas";

        $records = User::where([
            'is_coach' => true,
            'is_active' => true
        ])->whereHas('instructing', function ($q) use ($area, $discipline) {
            return $q->where([
                'area_id' => $area->id,
                'discipline_id' => $discipline->id,
            ]);
        })->get();

        return Inertia::render(
            'Webapp/Trainers/Index',
            compact('area', 'discipline', 'records')
        );
    }
}
