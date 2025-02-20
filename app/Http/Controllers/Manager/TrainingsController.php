<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Course::whereNull('area_id')->withCount('lessons')->with('trainer', 'discipline')->paginate(10);
        $pagination = (string) $records->onEachSide(1)->links();
        $category = "training";

        return Inertia::render('Admin/WellnessCenter/Course/Index', compact('records', 'pagination', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = [];
        $category = 'training';
        $trainers = User::where(['is_coach' => true, 'is_active' => true])->get();
        $disciplines = Discipline::whereNull('area_id')->where('is_active', true)->get();
        return Inertia::render(
            'Admin/WellnessCenter/Course/Create',
            compact('areas', 'disciplines', 'trainers', 'category')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Inertia::render('Admin/Training/Course/Show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Inertia::render('Admin/Training/Course/Show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('Admin/Training/Course/Edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
