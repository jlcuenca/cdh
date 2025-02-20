<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Post::orderBy('id', 'DESC')->paginate(10);
        $pagination = (string) $records->onEachSide(1);

        return Inertia::render(
            'Admin/Post/Index',
            compact('records', 'pagination')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Post/Create');
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
            'content' => 'required|string',
            'published' => 'required|boolean',
        ]);

        $path = null;

        if ($request->hasFile('file')) {
            $path = $request->file->store('posts', 'public');
        }

        $post = Post::create([
            'title' => $request->get('title'),
            'image' => $path,
            'excerpt' => $request->get('excerpt'),
            'content' => $request->get('content'),
            'published' => $request->get('published'),
        ]);

        return response()->json([
            'data' => $post,
            'redirectTo' => route('manager.posts.index')
        ]);
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
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Admin/Post/Edit', [
            'form' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'published' => 'required|boolean',
        ]);

        $post->title = $request->get('title');
        $post->excerpt = $request->get('excerpt');
        $post->content = $request->get('content');
        $post->published = $request->get('published');

        $post->save();

        return response()->json([
            'data' => $post,
            'redirectTo' => route('manager.posts.index')
        ]);
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
