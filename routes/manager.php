<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\MainController;
use App\Http\Controllers\Manager\CoachesController;
use App\Http\Controllers\Manager\CompaniesController;
use App\Http\Controllers\Manager\CompanyEmployeesController;
use App\Http\Controllers\Manager\AreasController;
use App\Http\Controllers\Manager\TrainingsController;
use App\Http\Controllers\Manager\DisiplinesController;
use App\Http\Controllers\Manager\CoursesController;
use App\Http\Controllers\Manager\LessonsController;
use App\Http\Controllers\Manager\DiagnoseController;
use App\Http\Controllers\Manager\QuestionController;
use App\Http\Controllers\Manager\AreaDisciplineController;
use App\Http\Controllers\Manager\CourseLesson;
use App\Http\Controllers\Manager\EvaluationController;
use App\Http\Controllers\Manager\SectionController;
use App\Http\Controllers\Manager\PostController;
use App\Http\Controllers\Manager\MultimediaController;
use App\Http\Controllers\Manager\ProfileController;
use App\Http\Controllers\Manager\EvaluationCompanyController;
use App\Http\Controllers\Manager\EvaluationCompanyEmployeesController;
use App\Http\Controllers\Manager\LessonMetrialController;
use App\Http\Controllers\Manager\CoursesUsers;

Route::group([
    'prefix' => '/manager',
    'as' => 'manager.',
    'middleware' => ['web', 'auth', 'has.role:manager']
], function ($r) {
    $r->get('/', [MainController::class, 'index'])->name('index');
    $r->resource('/coaches', CoachesController::class);
    $r->resource('/companies', CompaniesController::class);
    $r->resource('/companies.employees', CompanyEmployeesController::class);
    $r->resource('/areas', AreasController::class);
    $r->resource('/areas.disciplines', AreaDisciplineController::class);
    $r->resource('/disciplines', DisiplinesController::class);
    $r->resource('/trainings', TrainingsController::class);
    $r->resource('/trainings.lessons', LessonsController::class);
    $r->resource('/courses', CoursesController::class);
    $r->resource('/courses.lessons', CourseLesson::class);
    $r->resource('/courses.users', CoursesUsers::class);
    $r->resource('/lessons.material', LessonMetrialController::class);
    $r->resource('/evaluation', EvaluationController::class);
    $r->resource('/evaluation.companies', EvaluationCompanyController::class);
    $r->resource('/evaluation.companies.employee', EvaluationCompanyEmployeesController::class);
    $r->resource('/evaluation.sections', SectionController::class);
    $r->resource('/evaluation.sections.questions', QuestionController::class);
    $r->resource('/posts', PostController::class);
    $r->resource('/multimedia', MultimediaController::class);
    $r->resource('/profile',ProfileController::class);
    $r->resource('/users', CoachesController::class);

    $r->post('/course/{course}/subscription', [\App\Http\Controllers\Manager\CourseSubscribeController::class, 'update'])->name('course.subscription.update');
});
