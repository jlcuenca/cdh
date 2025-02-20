<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $company = $user->ownCompany;

        $employees = $company->employees()->withCount(['courses', 'courses as courses_completed_count' => function($q) {
            return $q->where('users_courses.completed', true)->toSql();
        }])->orderBy('id', 'DESC')->paginate(20);
        $pagination = (string) $employees->onEachSide(1)->links();

        $limited = $company->employees->count() === $company->max_employees;

        return Inertia::render('Webapp/Company/Index', compact('company', 'employees', 'pagination', 'limited'));
    }
}
