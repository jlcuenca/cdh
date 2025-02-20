<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeesEvaluationController extends Controller
{

    public function show(Request $request, Diagnose $evaluation, User $employee)
    {
        $user = auth()->user();
        $company = $user->ownCompany;
        $company->employees()->findOrFail($employee->id);

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


        return Inertia::render('Webapp/Company/Evaluation/Employee', compact('evaluation', 'sections', 'employee'));
    }
}
