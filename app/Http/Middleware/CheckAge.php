<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
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
        if ($request->age <= 200) {
            echo '中间件要求age大于200，没有通过！！（正常应该跳转error页面或者抛异常）';
            die;
//            return redirect('welcome');
        }
        return $next($request);
    }

    /**
     * 有些时候中间件需要在 HTTP 响应发送到浏览器后运行来处理一些任务。
     * 比如，Laravel 内置的「session」中间件存储的 session 数据是在响应被发送到浏览器之后才进行写入的。
     * 想实现这一点，你需要在中间件中定义一个 terminable 方法，它会在响应发送后自动被调用
     *
     * 一旦定义了 terminable 中间件，你便需要将它增加到 HTTP kernel 文件的全局中间件清单列表中
     * @param $request
     * @param $response
     */
//    public function terminate($request, $response)
//    {
//        // Store the session data...
//    }
}
