<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'wellness');
        return Inertia::render('Webapp/Courses/Index', compact('category'));
    }

    public function show(Request $request, Course $course)
    {
        $category = $request->get('category', 'wellness');
        return Inertia::render('Webapp/Courses/Index', compact('category'));
    }
}
