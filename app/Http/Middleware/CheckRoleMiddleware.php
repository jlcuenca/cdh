<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  String  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (auth()->check()) {

            $user = auth()->user();

            if ($role === 'manager') {
                if (!$user->is_manager) {
                    return redirect()->back();
                }
            } elseif ($role === 'employee') {
                if (!$user->is_student) {
                    return redirect()->back();
                }
            }
        }

        return $next($request);
    }
}
