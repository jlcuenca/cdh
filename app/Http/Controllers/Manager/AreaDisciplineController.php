<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AreaDisciplineController extends Controller
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
    public function create(Area $area)
    {
        $title = 'Disciplina';
        return Inertia::render('Admin/Area/Discipline/Create', compact('area', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Area $area)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'main_image' => 'required|file',
            'secondary_image' => 'required|file',
            'is_active' => 'required|boolean',
        ]);

        $main = $request->file('main_image')->store('discipline', 'public');
        $secondary = $request->file('secondary_image')->store('discipline', 'public');

        $discipline = $area->disciplines()->create([
            'name' => $request->get('name'),
            'main_image' => $main,
            'secondary_image' => $secondary,
            'is_active' => $request->get('is_active')
        ]);

        return response()->json($discipline, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Area $area
     * @param  Discipline $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area, Discipline $discipline)
    {
        $title = 'Disciplina - Área';
        return Inertia::render('Admin/Area/Discipline/Edit', compact('area', 'title', 'discipline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area, Discipline $discipline)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $discipline->name = $request->get('name');
        $discipline->is_active = $request->get('is_active');

        if ($request->hasFile('main_image')) {
            $main = $request->file('main_image')->store('area', 'public');
            $discipline->main_image = $main;
        }

        if ($request->hasFile('secondary_image')) {
            $secondary = $request->file('secondary_image')->store('area', 'public');
            $discipline->secondary_image = $secondary;
        }

        $discipline->save();

        return response()->json($discipline);
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
