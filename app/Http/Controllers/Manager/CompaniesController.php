<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Company::withCount(['employees' => function($q) {
            return $q->where('is_active', true);
        }])->paginate(10);

        $pagination = (string) $records->onEachSide(1)->links();

        return Inertia::render('Admin/Company/Index', compact('records', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Company/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'active' => 'required|boolean',
            'company_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'name' => 'required|string',
            'password' => 'required|string',
            'max_number_of_employees' => 'required|numeric|min:1|max:999999',
        ]);

        $password = $request->get('password');
        $active = $request->get('active');

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($password),
            'is_company' => true,
            'is_employee' => true,
            'is_active' => $active
        ]);

        $company = $user->ownCompany()->create([
            'name' => $request->get('company_name'),
            'is_active' => $active,
            'max_employees' => $request->get('max_number_of_employees')
        ]);

        $user->fresh();

        $user->companies()->attach($company->id);

        return response()->json($company);

    }

    /**
     * Display the specified resource.
     *
     * @param  Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $records = $company->employees()->paginate(10);
        $pagination = (string) $records->onEachSide(1)->links();

        return Inertia::render(
            'Admin/Company/Show',
            compact('company', 'records', 'pagination')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $user = $company->user;
        return Inertia::render('Admin/Company/Edit', compact('company', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request, [
            'company_name' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$company->user_id,
            'active' => 'required|boolean',
            'max_number_of_employees' => 'required|numeric|min:1|max:999999',
        ]);

        $password = $request->get('password', null);

        $company->name = $request->get('company_name');
        $company->max_employees = $request->get('max_number_of_employees');
        $company->is_active = $request->get('active');
        $company->save();

        $user = $company->user;
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if (!is_null($password)) {
            $user->password = Hash::make($password);
        }

        $user->save();

        return response()->json($company);
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
