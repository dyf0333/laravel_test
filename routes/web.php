<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});
Route::get('test1','TestController@test1');
Route::get('test2','TestController@test2');
Route::any('view','TestController@viewValidate');
Route::any('testValidate','TestController@testValidate');
Route::get('env','TestController@environment');


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
    echo '通过了中间件验证';
})->middleware('checkAge');
//中间件路由方式
//Route::get('/', function () {})->middleware('web');
//Route::group(['middleware' => ['web']], function () {});