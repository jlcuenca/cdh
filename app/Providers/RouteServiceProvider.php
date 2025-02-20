<?php

namespace App\Providers;

use App\Models\Area;
use App\Models\Company;
use App\Models\Course;
use App\Models\Diagnose;
use App\Models\DiagnoseSection;
use App\Models\Discipline;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/webapp';

    public const MANAGER = '/manager';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();


        Route::model('company',Company::class);
        Route::model('user',User::class);
        Route::model('coach',User::class);
        Route::model('employee',User::class);
        Route::model('area',Area::class);
        Route::model('course',Course::class);
        Route::model('lesson',Lesson::class);
        Route::model('diagnose',Diagnose::class);
        Route::model('evaluation',Diagnose::class);
        Route::model('section',DiagnoseSection::class);
        Route::model('discipline',Discipline::class);
        Route::model('post',Post::class);

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
