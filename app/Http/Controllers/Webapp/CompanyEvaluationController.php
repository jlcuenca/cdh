<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyEvaluationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->ownCompany;
        $employees_list = $company->employees()->select('users.id')->pluck('users.id');

        $evaluations = Diagnose::whereHas('users', function($q) use($employees_list) {
            return $q->whereIn('users.id', $employees_list);
        })->withCount(['users' => function($q) use($employees_list) {
            return $q->whereIn('users.id', $employees_list);
        }])->paginate(10);

        $pagination = (string) $evaluations->onEachSide(1)->links();
        $employeesCount = count($employees_list);

        return Inertia::render('Webapp/Company/Evaluation/Index', compact('evaluations', 'pagination', 'employeesCount'));
    }

    public function show(Request $request, $evaluationId)
    {
        $user = auth()->user();
        $company = $user->ownCompany;
        $employees_list = $company->employees()->select('users.id')->pluck('users.id');

        $evaluation = Diagnose::with([
            'users' => function ($q) use($employees_list) {
                return $q->whereIn('users.id', $employees_list);
            }
        ])->findOrFail($evaluationId);

        return Inertia::render('Webapp/Company/Evaluation/Show', compact('evaluation'));
    }
}
