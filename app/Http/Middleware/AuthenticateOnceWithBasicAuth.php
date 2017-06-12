<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * php artisan make:middlewaer AuthenticateOnceWithBasicAuth
 * 配合
 * Route::get('api/user', function () {})->middleware('auth.basic.once');
 * 实现无状态 HTTP 基础认证
 */
class AuthenticateOnceWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return Auth::onceBasic() ?: $next($request);
    }
}
