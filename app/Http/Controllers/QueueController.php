<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;

/**
 * 创建 queue表的命令
 *      php artisan queue:table
 *      php artisan queue:failed-table
 *      php artisan migrate
 */
class QueueController extends Controller
{
    public function index(){
        //因为基类controller use了DispatchesJobs
        dispatch(new SendEmail('目标邮箱地址'));

        //开启队列功能发送邮件
        //        php artisan queue:listen

        //查看失败了得队列任务
        //        php artisan queue:failed

        //重新发送失败了得队列任务
        //        php artisan queue:retry $id
        //        php artisan queue:retry all

        //删除失败了得队列任务
        //        php artisan queue:forget $id
        //        php artisan queue:flush
    }
}
