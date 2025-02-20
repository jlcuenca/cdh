<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        $evaluations = Diagnose::where('is_active', true)->get();

        $user = $request->user();
        $userEvaluations = $user->evaluations()->with('diagnose')->get();

        return Inertia::render('Webapp/Evaluation/Index', compact('evaluations', 'userEvaluations'));
    }

    public function show(Request $request, Diagnose $evaluation)
    {
        $user = $request->user();

        $sections = $evaluation->sections()->withCount([
            'questions',
            'usersAnswers' => function ($q) use($user) {
                return $q->where('user_id', $user->id);
            }
        ])->with(['questions' => function($q) use ($user) {
            return $q->with('userAnswers', function($q) use ($user) {
                return $q->where('user_id', $user->id)->with('answer');
            });
        }])->orderBy('id', 'ASC')->get();

        $completed = $sections->sum('questions_count') === $sections->sum('users_answers_count');

        $view = $completed ? 'Webapp/Evaluation/Completed' : 'Webapp/Evaluation/Show';

        return Inertia::render($view, compact('evaluation', 'sections'));
    }
}
