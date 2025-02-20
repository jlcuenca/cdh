<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Diagnose;
use App\Models\DiagnoseSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EvaluationSectionController extends Controller
{
    public function show(Diagnose $evaluation, DiagnoseSection $section)
    {
        $questions = $section->questions;
        return Inertia::render('Webapp/Evaluation/Section/Show', compact('evaluation', 'section', 'questions'));
    }
}
