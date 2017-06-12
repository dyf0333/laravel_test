<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //自定义认证 Guard
        Auth::extend('jwt', function ($app, $name, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\Guard...
            return new JwtGuard(Auth::createUserProvider($config['provider']));
        });

        //用户授权的Gate写法
        Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });
//        if (Gate::allows('update-post', $post)) {
//            // 当前用户可以更新 post...
//        }
//        if (Gate::denies('update-post', $post)) {
//            // 当前用户不能更新 post...
//        }
//        if (Gate::forUser($user)->allows('update-post', $post)) {
//            // 指定用户可以更新 post...
//        }
//        if (Gate::forUser($user)->denies('update-post', $post)) {
//            // 指定用户不能更新 post...
//        }


    }
}
