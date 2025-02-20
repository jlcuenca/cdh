<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Webapp\MainController;
use App\Http\Controllers\Webapp\CoursesController;
use App\Http\Controllers\Webapp\AreaController;
use App\Http\Controllers\Webapp\DisciplineController;
use App\Http\Controllers\Webapp\AreaDisciplineController;
use App\Http\Controllers\Webapp\AreaDisciplineCoachController;
use App\Http\Controllers\Webapp\CourseLessonController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Webapp\Api\LikeController;
use App\Http\Controllers\Webapp\PostController;
use App\Http\Controllers\Webapp\EvaluationController;
use App\Http\Controllers\Webapp\EvaluationSectionController;
use App\Http\Controllers\Webapp\EvaluationSectionQuestionsController;
use App\Http\Controllers\Webapp\LessonCommentController;
use App\Http\Controllers\Webapp\CompanyController;
use App\Http\Controllers\Webapp\CompanyEmployeeController;
use App\Http\Controllers\Webapp\ProfileController;
use App\Http\Controllers\Webapp\EmployeesEvaluationController;
use App\Http\Controllers\Webapp\CompanyEvaluationController;

Route::group([
    'prefix' => '/webapp',
    'middleware' => ['web', 'auth', 'has.role:employee'],
    'as' => 'webapp.'
], function() {

    Route::group([
        'prefix' => '/webapp',
        'as' => 'api.'
    ], function($api) {
        Route::resource('/lesson', VideoController::class);
        Route::post('/lesson/{lesson}/like', [LikeController::class, 'update'])->name('lesson.like');
        Route::resource('/evaluation.section.questions',EvaluationSectionQuestionsController::class);
    });

    Route::get('/', [MainController::class, 'index'])->name('index');

    Route::resource('/areas', AreaController::class);
    Route::resource('/areas.disciplines', AreaDisciplineController::class);
    Route::resource('/areas.disciplines.coaches', AreaDisciplineCoachController::class);
    Route::resource('/disciplines', DisciplineController::class);
    Route::resource('/courses', CoursesController::class);
    Route::resource('/courses.lessons', CourseLessonController::class);
    Route::resource('/lessons.comment', LessonCommentController::class);

    Route::resource('/topics', DisciplineController::class);
    Route::resource('/evaluation',EvaluationController::class);
    Route::resource('/evaluation.section',EvaluationSectionController::class);
    Route::resource('/company',CompanyController::class);
    Route::resource('/employees',CompanyEmployeeController::class);
    Route::resource('/company-evaluation',CompanyEvaluationController::class);
    Route::resource('/evaluation.employee',EmployeesEvaluationController::class);

    Route::get('/awards', [MainController::class, 'awards'])->name('awards');
    Route::resource('/profile',ProfileController::class);

    Route::get('/sessions', function () {
        return Inertia::render('User/Sessions');
    })->name('sessions');
    Route::get('/mail', function () {
        return Inertia::render('User/AnonymousMail');
    })->name('mail');
    Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
});
