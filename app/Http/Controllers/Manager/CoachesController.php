<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CoachesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::where('is_student', true)->withCount('courses')->paginate(10);
        $pagination = (string) $records->onEachSide(1)->links();
        return Inertia::render('Admin/Coach/Index', compact('records', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Coach/Create');
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
            'email' => 'required|email|unique:users',
            'is_active' => 'required|boolean',
            'firstname' => 'required|string',
            'paternal_lastname' => 'required|string',
            'maternal_lastname' => 'required|string',
            'gender' => 'required|string',
            'state_name' => 'required|string',
            'city_name' => 'required|string',
            'address' => 'sometimes|string',
            'date_of_birth' => 'sometimes|string',
            'postal_code' => 'sometimes|string',
            'phone' => 'sometimes|string',
        ]);

        $firstname = $request->get('firstname', null);
        $paternal_lastname = $request->get('paternal_lastname', null);
        $maternal_lastname = $request->get('maternal_lastname', null);

        $password = $request->get('password', null);
        $fullname = "$firstname $paternal_lastname $maternal_lastname";
        $password = is_null($password) ? Str::random('16') : $password;

        $user = User::create([
            'name' => $fullname,
            'email' => $request->get('email'),
            'password' => Hash::make($password),
            'is_student' => true,
            'is_active' => $request->get('is_active'),
            'firstname' => $firstname,
            'paternal_lastname' => $paternal_lastname,
            'maternal_lastname' => $maternal_lastname,
            'gender' => $request->get('gender', null),
            'state_name' => $request->get('state_name', null),
            'city_name' => $request->get('city_name', null),
            'address' => $request->get('address', null),
            'postal_code' => $request->get('postal_code', null),
            'date_of_birth' => $request->get('date_of_birth', null),
            'phone' => $request->get('phone', null),
        ]);

        return response()->json($user,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        $courses = Course::where('is_active', true)->withCount([
            'lessons',
            'progress' => function($q) use($student) {
                return $q->where('user_id', $student->id);
            },
            'progress as lessons_completed_count' => function($q) use($student) {
                return $q->where([
                    'user_id' => $student->id,
                    'completed' => true
                ]);
            }
        ])->with('users')->get();

        $registeredCourses = $courses->filter(function($course) use($student) {
            return $course->users()->where('user_id', $student->id)->first();
        });

        $availableCourses = $courses->filter(function($course) use($student) {
            return is_null($course->users()->where('user_id', $student->id)->first());
        });

        return Inertia::render('Admin/Coach/Show', compact('student' , 'availableCourses', 'registeredCourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $coach
     * @return \Illuminate\Http\Response
     */
    public function edit(User $coach)
    {
        return Inertia::render('Admin/Coach/Edit', compact('coach'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$user->id,
            'is_active' => 'required|boolean',
            'firstname' => 'required|string',
            'paternal_lastname' => 'required|string',
            'maternal_lastname' => 'required|string',
            'gender' => 'required|string',
            'state_name' => 'required|string',
            'city_name' => 'required|string',
            'address' => 'sometimes|string',
            'date_of_birth' => 'sometimes|string',
            'postal_code' => 'sometimes|string',
            'phone' => 'sometimes|string',
        ]);

        $firstname = $request->get('firstname', null);
        $paternal_lastname = $request->get('paternal_lastname', null);
        $maternal_lastname = $request->get('maternal_lastname', null);
        $fullname = "$firstname $paternal_lastname $maternal_lastname";

        $password = $request->get('password', null);

        if (!is_null($password)) {
            $user->password = $password;
        }

        $user->name = $fullname;
        $user->email = $request->get('email');
        $user->is_active = $request->get('is_active');
        $user->firstname = $request->get('firstname');
        $user->paternal_lastname = $request->get('paternal_lastname');
        $user->maternal_lastname = $request->get('maternal_lastname');
        $user->gender = $request->get('gender');
        $user->state_name = $request->get('state_name');
        $user->city_name = $request->get('city_name');
        $user->address = $request->get('address');
        $user->date_of_birth = $request->get('date_of_birth');
        $user->postal_code = $request->get('postal_code');
        $user->phone = $request->get('phone');
        $user->save();

        return response()->json($user);
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
