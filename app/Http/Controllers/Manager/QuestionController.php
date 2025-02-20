<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use App\Models\DiagnoseSection;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Question/Index');
    }

    public function create(Request $request, Diagnose $diagnose, DiagnoseSection $diagnoseSection)
    {
        $backTo = route('manager.evaluation.sections.show', [$diagnose->id, $diagnoseSection->id]);
        return Inertia::render(
            'Admin/Question/Create',
            compact('diagnose', 'diagnoseSection', 'backTo')
        );
    }

    public function store(Request $request, Diagnose $diagnose, DiagnoseSection $diagnoseSection)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'answers_type' => 'required|string'
        ]);

        $excerpt = $request->get('description', null);
        $answers_type = $request->get('answers_type');

        $question = $diagnoseSection->questions()->create([
            'diagnose_id' => $diagnose->id,
            'title' => $request->get('title'),
            'description' => $excerpt,
        ]);

        if ($answers_type === 'true_false') {
            $answers = [
                ['content' => 'Si', 'value' => 'yes'],
                ['content' => 'No', 'value' => 'no']
            ];
        } else {
            $answers = [
                ['content' => 'Siempre', 'value' => 'always'],
                ['content' => 'Casi siempre', 'value' => 'usually'],
                ['content' => 'Algunas veces', 'value' => 'sometimes'],
                ['content' => 'Casi nunca', 'value' => 'rarely'],
                ['content' => 'Nunca', 'value' =>'never'],
            ];
        }
        $question->answers()->createMany($answers);

        return response()->json([
            'data' => $question,
            'redirectTo' => route('manager.evaluation.sections.show', [$diagnose->id, $diagnoseSection->id])
        ]);
    }

    public function edit(Request $request, Diagnose $diagnose, DiagnoseSection $diagnoseSection, Question $question)
    {
        $answerType = $question->answers->first()->value === 'yes' ? 'true_false' : 'group_of_data';
        $backTo = route('manager.evaluation.sections.show', [$diagnose->id, $diagnoseSection->id]);
        return Inertia::render(
            'Admin/Question/Edit',
            compact('diagnose', 'diagnoseSection', 'backTo', 'question', 'answerType')
        );
    }

    public function update(Request $request, Diagnose $diagnose, DiagnoseSection $diagnoseSection, Question $question)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'answers_type' => 'required|string'
        ]);

        $excerpt = $request->get('description', null);
        $answers_type = $request->get('answers_type');

        $answerType = $question->answers->first()->value === 'yes' ? 'true_false' : 'group_of_data';

        if ($answerType !== $answers_type) {

            $question->answers()->delete();

            if ($answers_type === 'true_false') {
                $answers = [
                    ['content' => 'Si', 'value' => 'yes'],
                    ['content' => 'No', 'value' => 'no']
                ];
            } else {
                $answers = [
                    ['content' => 'Siempre', 'value' => 'always'],
                    ['content' => 'Casi siempre', 'value' => 'usually'],
                    ['content' => 'Algunas veces', 'value' => 'sometimes'],
                    ['content' => 'Casi nunca', 'value' => 'rarely'],
                    ['content' => 'Nunca', 'value' =>'never'],
                ];
            }

            $question->answers()->createMany($answers);
        }

        $question->title = $request->get('title');
        $question->description = $excerpt;

        $question->save();

        return response()->json([
            'data' => $question,
            'redirectTo' => route('manager.evaluation.sections.show', [$diagnose->id, $diagnoseSection->id])
        ]);
    }
}
