<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
USE Inertia\Inertia;

class CompanyEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        return Inertia::render('Admin/Company/Employee/Create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'active' => 'required|boolean',
            'password' => 'required|string',
            'email' => 'required|email|unique:users',
        ]);

        $password = $request->get('password');

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($password),
            'is_employee' => true,
            'is_active' => $request->get('active'),
        ]);

        $company->employees()->attach($user->id);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Company $company, User $employee)
    {
        return Inertia::render('Admin/Company/Employee/Edit', compact('company', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, User $employee)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'active' => 'required|boolean',
            'email' => "required|email|unique:users,email,$employee->id",
        ]);

        $password = $request->get('password', null);

        if (!is_null($password)) {
            $employee->password = Hash::make($password);
        }

        $employee->name = $request->get('name');
        $employee->email = $request->get('email');
        $employee->is_active = $request->get('active');
        $employee->save();

        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
