<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Diagnose::withCount('sections')->paginate(10);
        $pagination = (string) $records->onEachSide(1)->links();

        return Inertia::render('Admin/Evaluation/Index', compact('records', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $backTo = route('manager.evaluation.index');
        return Inertia::render('Admin/Evaluation/Create', compact('backTo'));
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
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'is_active' => 'required|boolean'
        ]);

        $record = Diagnose::create([
            'title' => $request->get('title'),
            'excerpt' => $request->get('excerpt'),
            'is_active' => $request->get('is_active'),
        ]);

        $data = [
            'data' => $record,
            'redirectTo' => route('manager.evaluation.sections.index', $record->id)
        ];

        return response()->json($data, 201);
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
     * @param  Diagnose $diagnose
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnose $diagnose)
    {
        $backTo = route('manager.evaluation.index');
        return Inertia::render('Admin/Evaluation/Edit', compact('backTo', 'diagnose'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnose $diagnose)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'is_active' => 'required|boolean'
        ]);

        $diagnose->title = $request->get('title');
        $diagnose->excerpt = $request->get('excerpt');
        $diagnose->is_active = $request->get('is_active');

        $diagnose->save();

        $data = [
            'data' => $diagnose,
            'redirectTo' => route('manager.evaluation.edit', $diagnose->id)
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
