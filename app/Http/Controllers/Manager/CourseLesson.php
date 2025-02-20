<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseLesson extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Course $course)
    {
        $records = $course->lessons()->withCount('materials')->orderBy('id', 'ASC')->paginate();
        $pagination = (string) $records->onEachSide(1)->links();

        return Inertia::render('Admin/WellnessCenter/Course/Lesson/Index', compact('course','records', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Course $course)
    {
        return Inertia::render('Admin/Lesson/Create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'hours_duration' => 'required|string',
            'minutes_duration' => 'required|string',
            'is_active' => 'required|boolean',
            'file' => 'required|file',
        ]);

        $source = $request->get('video_source', null);
        $source_url = $request->get('video_url', null);

        $image = $request->file('file')->store('thumbnail', 'public');

        if ($course->category === 'wellness') {
            $request->merge(['user_id' => $course->user_id]);
        }

        $hh = $request->get('hours_duration');
        $mm = $request->get('minutes_duration');

        $duration = "$hh:$mm:00";

        $lesson = $course->lessons()->create([
            'title' => $request->get('title'),
            'excerpt' => $request->get('excerpt'),
            'hours_duration' => $hh,
            'minutes_duration' => $mm,
            'duration' => $duration,
            'thumbnail_url' => $image,
            'video_url' => $request->get('video_url'),
            'video_source' => $request->get('video_source'),
            'is_active' => $request->get('is_active'),
        ]);

        return response()->json([
            'data' => $lesson,
            'redirect' => route('manager.courses.lessons.edit',[$lesson->course_id,  $lesson->id])
        ], 201);
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
     * @param  Course $course
     * @param  Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Lesson $lesson)
    {
        $lesson->load('materials');
        return Inertia::render('Admin/Lesson/Edit', compact('course', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Course $course
     * @param  Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'hours_duration' => 'required|string',
            'minutes_duration' => 'required|string',
            'video_url' => 'required|string',
            'video_source' => 'required|string',
            'score' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
            'user_id' => 'required_if:category,training'
        ]);

        if ($course->category === 'wellness') {
            $request->merge(['user_id' => $course->user_id]);
            $lesson->user_id = $course->user_id;
        }

        $hh =  $request->get('hours_duration');
        $mm =  $request->get('minutes_duration');

        $duration = "$hh:$mm:00";

        if ($request->hasFile('file')) {
            $image = $request->file('file')->store('thumbnail', 'public');
            $lesson->thumbnail_url = $image;
        }

        $lesson->title = $request->get('title');
        $lesson->excerpt = $request->get('excerpt');
        $lesson->hours_duration = $hh;
        $lesson->minutes_duration = $mm;
        $lesson->duration = $duration;
        $lesson->video_url = $request->get('video_url');
        $lesson->video_source = $request->get('video_source');
        $lesson->score = $request->get('score');
        $lesson->is_active = $request->get('is_active');

        $lesson->save();

        return response()->json($lesson);
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
