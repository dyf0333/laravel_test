<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * 资源控制器：
 * 生成命令
 *  php artisan make:controller PhotoController --resource
 * 或者绑定模型的生成命令
 *  php artisan make:controller PhotoController --resource --model=Photo
 *
 *  对应的路由在 routes/web.php
 *      Route::resource('photos', 'PhotoController');
 */
class PhotoController extends Controller
{

//资源控制器操作处理

//动作	URI	操作	路由名称
//GET	/photos	index	photos.index
//GET	/photos/create	create	photos.create
//POST	/photos	store	photos.store
//GET	/photos/{photo}	show	photos.show
//GET	/photos/{photo}/edit	edit	photos.edit
//PUT/PATCH	/photos/{photo}	update	photos.update
//DELETE	/photos/{photo}	destroy	photos.destroy

//部分方法，PUT，PATCH 或者 DELETE 请求，在表单发送时候，需要补足方式
//添加一个 _method 隐藏域字段来伪造 HTTP 动作
//    {{ method_field('PUT') }}

    public function index()
    {
        echo 'get index';
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
