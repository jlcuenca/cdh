<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Course;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class CompanyEmployeeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $company = $user->ownCompany;

        $limited = $company->employees->count() === $company->max_employees;

        if ($limited) {
            return redirect()->back();
        }

        return Inertia::render('Webapp/Company/Employee/Create', compact('company'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $company = $user->ownCompany;

        $limited = $company->employees->count() === $company->max_employees;

        if ($company->user_id !== $user->id || $limited) {
            return response()->json([
                "message" => 'No autorizado'
            ], 401) ;
        }

        $this->validate($request, [
            'name' => 'required|string',
            'is_active' => 'required|boolean',
            'password' => 'required|string',
            'email' => 'required|email|unique:users',
        ]);

        $password = $request->get('password');

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($password),
            'is_employee' => true,
            'is_active' => $request->get('is_active'),
        ]);

        $company->employees()->attach($user->id);

        return response()->json($user, 201);
    }

    /**
     * @param Request $request
     * @param User $employee
     * @return \Inertia\Response
     */
    public function edit(Request $request, User $employee)
    {
        $user = $request->user();
        $company = $user->ownCompany;
        $company->employees()->findOrFail($employee->id);

        return Inertia::render('Webapp/Company/Employee/Edit', compact('employee'));
    }

    /**
     * @param Request $request
     * @param User $employee
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $employee)
    {

        $user = $request->user();
        $company = $user->ownCompany;

        if ($company->user_id !== $user->id) {
            return response()->json([
                "message" => 'No autorizado'
            ], 401) ;
        }

        $company->employees()->findOrFail($employee->id);

        $this->validate($request, [
            'name' => 'required|string',
            'is_active' => 'required|boolean',
            'email' => "required|email|unique:users,email,$employee->id",
        ]);

        $password = $request->get('password', null);

        if (!is_null($password)) {
            $employee->password = Hash::make($password);
        }

        $employee->name = $request->get('name');
        $employee->email = $request->get('email');
        $employee->is_active = $request->get('is_active');
        $employee->save();

        return response()->json($employee);
    }

    /**
     * @param Request $request
     * @param User $employee
     * @return \Inertia\Response
     */
    public function show(Request $request, User $employee)
    {
        $user = $request->user();
        $company = $user->ownCompany;

        $company->employees()->findOrFail($employee->id);

        $records = $employee->courses()->with('progress')->withCount([
            'lessons' => function($q) {
                return $q->where('is_active', true);
            },
            'likes',
            'progress' => function($q) use($employee) {
                return $q->where('user_id', $employee->id);
            },
            'progress as lessons_completed_count' => function($q) use($employee) {
                return $q->where([
                    'user_id' => $employee->id,
                    'completed' => true
                ]);
            }
        ])->get();

        return Inertia::render('Webapp/Company/Employee/Show', compact('employee', 'records'));
    }
}
