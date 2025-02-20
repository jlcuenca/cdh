<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Area::paginate(10);
        $pagination = (string) $records->onEachSide(1)->links();

        return Inertia::render('Admin/Area/Index', compact('records', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Area/Create');
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
            'name' => 'required|string',
            'main_image' => 'required|file',
            'secondary_image' => 'required|file',
            'is_active' => 'required|boolean',
        ]);

        $main = $request->file('main_image')->store('area', 'public');
        $secondary = $request->file('secondary_image')->store('area', 'public');

        $area = Area::create([
            'name' => $request->get('name'),
            'main_image' => $main,
            'secondary_image' => $secondary,
            'is_active' => $request->get('is_active')
        ]);

        return response()->json($area, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        $records = $area->disciplines()->paginate(10);
        $pagination = (string) $records->onEachSide(1)->links();
        $redirectTo = route('manager.areas.index');

        return Inertia::render('Admin/Area/Show', compact('area', 'records', 'pagination', 'redirectTo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return Inertia::render('Admin/Area/Edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $area->name = $request->get('name');
        $area->is_active = $request->get('is_active');

        if ($request->hasFile('main_image')) {
            $main = $request->file('main_image')->store('area', 'public');
            $area->main_image = $main;

        }

        if ($request->hasFile('secondary_image')) {
            $secondary = $request->file('secondary_image')->store('area', 'public');
            $area->secondary_image = $secondary;
        }

        $area->save();

        return response()->json($area);
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
