<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function show(Request $request, $post)
    {
        if (!$post->published) {
            return redirect()->back();
        }

        return Inertia::render('Webapp/Post/Show', compact('post'));
    }
}
