<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //共享特定的数据给应用程序中所有的视图
        View::share('key', 'value');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

//        绑定实现 容器 和 合同功能 ；Contracts & Facades
//        切换工具方式，不需要重新编写，而只修改配置工具
//        $this->app->bind('XXX', function ($app) {
//            if (config('cache.enable') == 'true') {
//                return new Cacheable();
//            } else {
//                return new NoCache();
//            }
//        });
    }
}
