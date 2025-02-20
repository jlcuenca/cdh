<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Diagnose;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EvaluationCompanyEmployeesController extends Controller
{
    public function show(Request $request, Diagnose $evaluation, Company $company, User $employee)
    {
        $sections = $evaluation->sections()->withCount([
            'questions',
            'usersAnswers' => function ($q) use($employee) {
                return $q->where('user_id', $employee->id);
            }
        ])->with(['questions' => function($q) use ($employee) {
            return $q->with('userAnswers', function($q) use ($employee) {
                return $q->where('user_id', $employee->id)->with('answer');
            });
        }])->orderBy('id', 'ASC')->get();


        return Inertia::render('Admin/Evaluation/Employee/Show', compact('evaluation', 'sections','company', 'employee'));
    }
}
