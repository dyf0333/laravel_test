<?php

//基于闭包的路由并不能被缓存。如果要使用路由缓存，你必须将所有的闭包路由转换成控制器类
//创建路由缓存：
//    php artisan route:cache
//清除路由缓存：
//    php artisan route:clear

Route::get('viewAction','ViewController@index');
Route::get('blade', function () {
    return view('child');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('test1','TestController@test1');
Route::get('test2','TestController@test2');
Route::any('view','TestController@viewValidate');
Route::any('testValidate','TestController@testValidate');
Route::get('env','TestController@environment');
Route::get('mail','MailController@index');
Route::get('log','LogController@index');
Route::get('queue','QueueController@index');



//as给路由起别名
Route::get('env',['as'=>'env','uses'=>'TestController@environment']);

Route::get('test_get', function () {
    echo 'get 方式路由';
});
Route::post('test_get', function () {
    echo 'post 方式路由';
});
Route::put('test_get', function () {
    echo 'put 方式路由';
});
Route::patch('test_get', function () {
    echo 'patch 方式路由';
});
Route::delete('test_get', function () {
    echo 'delete 方式路由';
});
Route::options('test_get', function () {
    echo 'options 方式路由';
});
Route::match(['get', 'post'], 'test_match', function () {
    echo 'match 方式路由';
});
Route::any('test_any', function () {
    echo 'any 方式路由';
});

//有参数的路由：
Route::get('test_params/{id}', function ($id) {
    return '参数id是 '.$id;
});
Route::get('test_params/id/{id}/name/{name}', function ($id, $name) {
    return '多个参数 id : '.$id . ' name :' . $name;
});
//可选参数
Route::get('test_params/{ids?}', function ($ids = '') {
    return $ids;
});
//运用where正则规范路由
Route::get('test_params/{name}', function ($name) {})->where('name', '[A-Za-z]+');
Route::get('test_params/{id}', function ($id) {})->where('id', '[0-9]+');
Route::get('test_params/{id}/{name}', function ($id, $name) {})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
//name方法命名路由
Route::get('test_params/id', 'TestController@view')->name('testView');
//用route方法可以获取到已经命名的路由
//route('testView');

//name方法命名路由，有参数的方式
Route::get('test_params/{id}', function ($id) {})->name('testView');
//$url = route('testView', ['id' => 1]);

//路由组
    //中间件
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function ()    {
        // 使用 `Auth` 中间件
    });
    Route::get('user/profile', function () {
        // 使用 `Auth` 中间件
    });
});
    //命名空间
Route::group(['namespace' => 'Admin'], function () {
    // 在 "App\Http\Controllers\Admin" 命名空间下的控制器
});
    //子域名路由
Route::group(['domain' => '{account}.test.com'], function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});
    //路由前缀
Route::group(['prefix' => 'admin'], function () {
    Route::get('users', function ()    {
        // 匹配包含 "/admin/users" 的 URL
    });
});

//路由模型绑定写法
Route::get('api/users/{user}', function (App\User $user) {
    return $user->email;
});

//中间件路由方式
Route::get('checkAge/{age}', function () {
    echo '通过了中间件验证，正常输出数据';
})->middleware('checkAge');
//中间件路由方式
//Route::get('/', function () {})->middleware('web');
//Route::group(['middleware' => ['web']], function () {});


//单一操作控制器注册路由时，无需指定方法
Route::get('danyi/{id}', 'Danyi');

//资源路由（全都选择）
Route::resource('photos', 'PhotoController');

//资源路由（选择部分，或者摒弃部分）
Route::resource('photo', 'PhotoController', ['only' => [
    'index', 'show'
]]);
Route::resource('photo', 'PhotoController', ['except' => [
    'create', 'store', 'update', 'destroy'
]]);

//命名资源路由
Route::resource('photo', 'PhotoController', ['names' => [
    'create' => 'photo.build'
]]);


//获取请求 （闭包方式）
Route::get('request', function (\Illuminate\Http\Request $request) {
    $uri = $request->path();
    if ($request->is('admin/*')) {}
    $url = $request->url();
    $url = $request->fullUrl();
    $method = $request->method();
    if ($request->isMethod('post')) {}
});


//相应 header
Route::get('request', function () {
    return response('Hello World', 200)
        ->header('Content-Type', 'text/plain');

//    return response($content)
//        ->header('Content-Type', $type)
//        ->header('X-Header-One', 'Header Value')
//        ->header('X-Header-Two', 'Header Value');

//    return response($content)
//        ->withHeaders([
//            'Content-Type' => $type,
//            'X-Header-One' => 'Header Value',
//            'X-Header-Two' => 'Header Value',
//        ]);

    //cookie
//    return response($content)
//        ->header('Content-Type', $type)
//        ->cookie('name', 'value', $minutes);
});

//重定向
Route::get('redirect', function () {
    return redirect('home/dashboard');

    //回到上一级
    return back()->withInput();

    //重定向到命名了得路由
    return redirect()->route('login');
    return redirect()->route('profile', ['id' => 1]); //含参数

    //重定向到控制器方法
    return redirect()->action('HomeController@index');
    return redirect()->action('UserController@profile', ['id' => 1]);

    //重定向 带上session闪存数据
    return redirect('dashboard')->with('status', 'Profile updated!');

    //blade模板获取闪存数据
//    @if (session('status'))
//    <div class="alert alert-success">
//        {{ session('status') }}
//    </div>
//    @endif
});

//相应 view 、 json 、 强制下载
Route::get('request', function () {
    $data = '';
    $type= '';
    return response()->view('hello', $data, 200)->header('Content-Type', $type);
    return view('welcome');

    return response()->json(['name' => 'Abigail','state' => 'CA']);
    //JSONP 相应
    return response()->json(['name' => 'Abigail', 'state' => 'CA'])->withCallback($request->input('callback'));

    //强制下载
    return response()->download($pathToFile);
    return response()->download($pathToFile, $name, $headers);

    //相应文件
    return response()->file($pathToFile);
    return response()->file($pathToFile, $headers);
});


//php artisan make:auth 命令自动生成的路由
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//http基础认证 提供一个快速的方法来认证用户
//不需要任何「登录」页面。开始之前，
//先增加 auth.basic 中间件 到你的路由，
//auth.basic 中间件已经被包含在 Laravel 框架中，所以你不需要定义它：
//默认情况下，auth.basic 中间件将会使用用户的 email 字段当作「用户名」。
Route::get('profile', function () {
    // 只有认证过的用户可进入...
})->middleware('auth.basic');
//如果是正在使用 FastCGI，则 HTTP 的基础认证可能无法正常运作，你需要将下面这几行加入你 .htaccess 文件中：
//RewriteCond %{HTTP:Authorization} ^(.+)$
//RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]


//无状态 HTTP 基础认证
//API认证。
//定义一个中间件 并调用 onceBasic 方法
Route::get('api/user', function () {
    // 只有认证过的用户可以进入...
})->middleware('auth.basic.once');


//程序内部调用 自定义的 artisan 命令
Route::get('/sendEmail', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('email:send', [
        'user' => 1, '--queue' => 'default'
    ]);
});