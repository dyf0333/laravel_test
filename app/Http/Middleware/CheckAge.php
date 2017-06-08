<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    public function handle($request, Closure $next)
    {
        if ($request->input('age') <= 200) {
            return redirect('welcome');
        }
        return $next($request);
    }
}