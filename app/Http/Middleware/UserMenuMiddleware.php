<?php

namespace App\Http\Middleware;

use App\Classes\UserDepartments;
use Closure;
use Auth;

class UserMenuMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::guard('web')->user()) {
            $departmentsObject = new UserDepartments();
            $departments = $departmentsObject->getAllDepartments();

            view()->share('departments', $departments);
        }

        return $next($request);
    }
}
