<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $records = Area::where('is_active', true)->get();
        return Inertia::render('Webapp/Areas/Index', compact('records'));
    }

    public function show(Request $request, Area $area)
    {
        $records = Area::where('is_active', true)->get();
        return Inertia::render('Webapp/Areas/Index', compact('records'));
    }
}
