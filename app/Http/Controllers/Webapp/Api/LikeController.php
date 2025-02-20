<?php

namespace App\Http\Controllers\Webapp\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function update(Request $request, Lesson $lesson)
    {
        $this->validate($request, [
            'liked' => 'required|boolean'
        ]);

        $liked = $request->get('liked');

        $user = $request->user();
        $id = $lesson->id;
        if ($liked) {
            $user->likes()->attach($id);
        } else {
            $user->likes()->detach($id);
        }

        return response()->json([
            'data' => [
                'liked' => $liked
            ]
        ]);
    }
}
