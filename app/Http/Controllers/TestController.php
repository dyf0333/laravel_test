<?php

namespace App\Http\Controllers;

use App\Test;
use Dotenv\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    /**
     * 能获取到的环境变量
     */
    public function environment(){
        $environment = App::environment();
        $version = App::version();
        $basePath = App::basePath();

        $route = Route::current();
        $name = Route::currentRouteName();
        $action = Route::currentRouteAction();

        $data = [
            'environment' => $environment,
            'version' => $version,
            'basePath' => $basePath,
            'config.app' => config('app'),
            'route'=>$route,
            'name'=>$name,
            'action'=>$action,
        ];
        dd($data);
    }

    /**
     * new一个model方式获取数据并展示
     */
    public function test1(){
        $testModel= new Test();
        $result = $testModel->all();
        dd($result);
    }

    /**
     * 用DB静态方法写一个sql语句获取数据并展示
     */
    public function test2(){
        $res = DB::select('select * from Test');
        dd($res);
    }

    public function viewValidate(){
        return view('validator');
    }
    public function testValidate(){
        $input = Input::all();
        dd($input);die;
        $rules = [
            'password'=>'required|between:6,20|confirmed',
        ];
        $message = [
            'password.required'=>'密码不能为空',
            'password.between'=>'密码需在6-20位之间',
            'password.confirmed'=>'新旧密码需一致', //form里确认密码字段需改成 password_confirm
        ];
        Validator::make($input,$rules,$message);
    }
}
