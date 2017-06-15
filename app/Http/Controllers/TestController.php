<?php

namespace App\Http\Controllers;

use App\Test;
use Dotenv\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{

    /**
     * 在控制器的构造方法中指定中间件会更为便捷。
     * 在控制器构造方法中使用 middleware 方法，
     * 你可以很容易地将中间件指定给控制器操作。
     *
     * 你甚至可以约束中间件只对控制器类中的某个特定方法生效：
     * TestController constructor.
     *
     * （当然也可以在路由文件制定，详见routes/web.php对应中间件的路由写法）
     */
    public function __construct()
    {
//        $this->middleware('CheckAge');
//        $this->middleware('CheckAge')->only('index');
//        $this->middleware('CheckAge')->except('store');
//        闭包式写法
//        $this->middleware(function ($request, $next) {
//             todo
//            return $next($request);
//        });
    }

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


    /**
     * 手动创建validate
     */
    public function testValidate(){
        $input = Input::all();

        $rules = [
            'password'=>'required|between:6,20|confirmed',
        ];
        $message = [
            'password.required'=>'密码不能为空',
            'password.between'=>'密码需在6-20位之间',
            'password.confirmed'=>'新旧密码需一致', //form里确认密码字段需改成 password_confirm
        ];
        $validator = Validator::make($input,$rules,$message);

        if ($validator->fails()) {
            return redirect('post/create')
                ->withErrors($validator)
                ->withInput(); //数据保持 withInput后，在view层获取方法：{{ old('user')['name'] }}
        }

        //如果你想手动创建一个验证器实例，但希望继续享用 ValidatesRequest 特性提供的自动跳转功能，
        //那么你可以调用一个现存的验证器实例中的 validate 方法。
        //如果验证失败了，用户会被自动重定向，或者在 AJAX 请求中，一个 JSON 格式的响应将会被返回：
        //$validator = Validator::make($input,$rules,$message)->validate();

        $errors = $validator->errors();
        echo $errors->first('email');
        foreach ($errors->get('email') as $message) {
            echo $message;
        }
        foreach ($errors->get('attachments.*') as $message) {
            echo $message;
        }
        foreach ($errors->all() as $message) {
            echo $message;
        }
        if ($errors->has('email')) {
            echo '验证email失败';
        }


    }


}
