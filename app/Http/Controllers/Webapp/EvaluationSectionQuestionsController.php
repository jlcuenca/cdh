<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use App\Models\DiagnoseSection;
use Illuminate\Http\Request;

class EvaluationSectionQuestionsController extends Controller
{
    /**
     * @param Request $request
     * @param Diagnose $evaluation
     * @param DiagnoseSection $section
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Diagnose $evaluation, DiagnoseSection $section)
    {
        $questions = $section->questions()->with('answers')->paginate(1);

        return response()->json($questions);
    }

    /**
     * @param Request $request
     * @param Diagnose $evaluation
     * @param DiagnoseSection $section
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Diagnose $evaluation, DiagnoseSection $section)
    {
        $this->validate($request, [
            'question' => 'required|integer',
            'answer' => 'required|integer'
        ]);

        $user = $request->user();

        $user->evaluations()->updateOrCreate([
            'diagnose_id' => $evaluation->id,
        ], [
            'needs_attention' => false
        ]);

        $user->evaluationAnswers()->updateOrCreate([
            'diagnose_id' => $evaluation->id,
            'diagnose_section_id' => $section->id,
            'question_id' => $request->get('question'),
        ], [
            'answer_id' => $request->get('answer')
        ]);

        return response()->json(null, 204);
    }
}
