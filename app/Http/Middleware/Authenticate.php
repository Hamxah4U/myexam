<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('student') || $request->is('student/*')) {
                return route('student.login');
            }
            return route('login'); 
        }
    }
}
