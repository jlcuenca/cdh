<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'wellness');

        $records = Course::withCount('lessons', 'users')->paginate(10);

        $pagination = (string) $records->onEachSide(1)->links();

        return Inertia::render('Admin/WellnessCenter/Course/Index', compact('records', 'pagination', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Admin/WellnessCenter/Course/Create');
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
            'excerpt' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $image = null;

        if ($request->hasFile("image")) {
            $image = $request->image->store('course', 'public');
        }

        $course = Course::create([
            'title' => $request->get('title'),
            'excerpt' =>$request->get('excerpt'),
            'is_active' => $request->get('is_active'),
            'image_url' => $image
        ]);

        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Inertia::render('Admin/WellnessCenter/Course/Show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Course $course)
    {
        return Inertia::render(
            'Admin/WellnessCenter/Course/Edit',
            compact('course')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'category' => 'required|string',
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'user_id' => 'required_if:category,wellness',
            'area_id' => 'required_if:category,wellness',
            'discipline_id' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);


        $course->title = $request->get('title');
        $course->excerpt = $request->get('excerpt');

        if ($course->category === 'wellness') {
            $course->user_id = $request->get('user_id', null);
            $course->area_id = $request->get('area_id');
        }

        $course->discipline_id = $request->get('discipline_id');
        $course->is_active = $request->get('is_active');

        if ($request->hasFile("image")) {
            $image = $request->image->store('course', 'public');
            $course->image_url = $image;
        }

        $course->save();

        return response()->json($course);
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
