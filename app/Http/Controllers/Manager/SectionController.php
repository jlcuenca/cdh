<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use App\Models\DiagnoseSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Diagnose $diagnose)
    {
        $records = $diagnose->sections()->withCount('questions')->get();
        return Inertia::render(
            'Admin/Section/Index',
            compact('diagnose', 'records')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Diagnose $diagnose)
    {
        $backTo = route('manager.evaluation.sections.index', $diagnose->id);

        return Inertia::render(
            'Admin/Section/Create',
            compact('diagnose', 'backTo')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Diagnose $diagnose)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'required|string',
        ]);

        $record = $diagnose->sections()->create([
            'title' => $request->get('title'),
            'excerpt' => $request->get('excerpt'),
        ]);

        $data = [
            'data' => $record,
            'redirectTo' => route('manager.evaluation.sections.questions.create', [$diagnose->id, $record->id])
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Diagnose $diagnose, DiagnoseSection $diagnoseSection)
    {
        $records = $diagnoseSection->questions()->with('answers')->get();
        return Inertia::render(
            'Admin/Section/Show',
            compact('diagnose', 'diagnoseSection', 'records')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Diagnose $diagnose
     * @param  DiagnoseSection $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnose $diagnose, DiagnoseSection $section)
    {
        $backTo = route('manager.evaluation.sections.index', [$diagnose->id]);

        return Inertia::render(
            'Admin/Section/Edit',
            compact('diagnose', 'backTo', 'section')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnose $diagnose, DiagnoseSection $section)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'required|string',
        ]);

        $section->title = $request->get('title');
        $section->excerpt = $request->get('excerpt');
        $section->save();

        $backTo = route('manager.evaluation.sections.edit', [$diagnose->id, $section->id]);

        $data = [
            'data' => $section,
            'redirectTo' => $backTo
        ];

        return response()->json($data);
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
