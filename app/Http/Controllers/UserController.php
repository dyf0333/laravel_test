<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


/**
 * 注入
 */
class UserController extends Controller
{
    /**
     * 用户 repository 实例。
     */
    protected $users;

    /**
     *  构造方法注入
     *
     * 创建一个新的控制器实例。
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }


    /**
     *  方法注入
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
    }

    /**
     * 路由有参数的方法注入
     *
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {}

    /**
     * 解析request各个参数与方法
     */
    public function params(Request $request){
        $uri = $request->path();
        if ($request->is('admin/*')) {}
        $url = $request->url();
        $url = $request->fullUrl();
        $method = $request->method();
        if ($request->isMethod('post')) {}

        //获取所有输入数据
        $input = $request->all();
        //获取id 参数
        $id = $request->input('id');
        //参数默认值方式
        $id = $request->input('id', 0);
        //参数若是数组
        $name = $request->input('products.0.name');
        $names = $request->input('products.*.name');
        //部分参数
        $input = $request->only(['username', 'password']);
        $input = $request->only('username', 'password');
        $input = $request->except(['credit_card']);
        $input = $request->except('credit_card');
        //判断参数是否存在
        $hasName = $request->has('name');
    }

    /**
     * Illuminate\Http\Request 的 flash 方法会将当前输入的数据存进 session 中
     * 因此下次用户发送请求到应用程序时就可以使用它们：
     */
    public function paramsFlash(Request $request){
        $request->flash();

        //保存部分数据
        $request->flashOnly(['username', 'email']);
        $request->flashExcept('password');

        //闪存并重定向
//        return redirect('form')->withInput();
//        return redirect('form')->withInput(
//            $request->except('password')
//        );

        //获取闪存的旧数据
        $username = $request->old('username');
        //在blade模板输出，若没有，就为null
//        <input type="text" name="username" value="{{ old('username') }}">
    }

    /**
     *  响应到cookie并保存数据
     */
    public function paramsCookie(Request $request){
//        return response('Hello World')->cookie(
//            'name', 'value', $minutes, $path, $domain, $secure, $httpOnly
//        );

//        $cookie = cookie('name', 'value', $minutes);
//        return response('Hello World')->cookie($cookie);
    }
}
