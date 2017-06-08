<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');
//Route::match(['get','post'],'/a', function () {
//    return redirect()->route('welcome');
//});
//Route::get('user/{id}', function ($id) {
//    return 'hahah  *** '.$id;
//})->name('userId');

Route::get('Dyf','DyfController@pdo');

//Route::get('userController','UserController@show');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web']], function () {
//    //
//});
//
//Route::group(['middleware' => 'web'], function () {
//    Route::auth();
//
//    Route::get('/home', 'HomeController@index');
//});
