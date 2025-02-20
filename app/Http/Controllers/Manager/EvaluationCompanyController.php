<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Diagnose;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EvaluationCompanyController extends Controller
{
    public function index(Request $request, Diagnose $evaluation)
    {
        $users_list = $evaluation->users()->select('users.id')->pluck('users.id');

        $companies = Company::whereHas('employees', function($q) use($users_list) {
            return $q->whereIn('id', $users_list);
        })->withCount([
            'employees as employees_evaluation_count' => function($q) use($users_list) {
                return $q->whereIn('id', $users_list);
            },
            'employees'
        ])->paginate(10);

        $pagination = (string) $companies->onEachSide(1)->links();

        return Inertia::render('Admin/Evaluation/Company/Index', compact('evaluation', 'companies', 'pagination'));
    }

    public function show(Request $request, Diagnose $evaluation, Company $company)
    {
        $records = $company->employees()->whereHas('evaluations', function($q) use($evaluation) {
            return $q->where('diagnose_id', $evaluation->id);
        })->paginate(10);
        $pagination = (string) $records->onEachSide(1)->links();

        return Inertia::render('Admin/Evaluation/Company/Show', compact('evaluation', 'records', 'pagination', 'company'));
    }
}
