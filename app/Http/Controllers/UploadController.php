<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * 上传文件资源
 */
class UploadController extends Controller
{
    public function index(Request $request){
        //获取上传文件
        $file = $request->file('photo');
        $file = $request->photo;

        //检查上传文件
        if ($request->hasFile('photo')){}
        if ($request->file('photo')->isValid()) {}

        //文件后缀
        $path = $request->photo->path();
        $extension = $request->photo->extension();
        $file->getClientOriginalName();
        $file->getClientOriginalExtension();
        $file->getClientMineType();
        $file->getRealPath();

        //存储上传的文件
        //store 方法允许存储文件到相对于文件系统根目录配置的路径。这个路径不能包含文件名，名称将使用 MD5 散列文件内容自动生成。
        //store 方法还接受一个可选的第二个参数，用于文件存储到磁盘的名称。这个方法会返回文件相对于磁盘根目录的路径：
        $path = $request->photo->store('images');
        $path = $request->photo->store('images', 's3');
        $path = $request->photo->storeAs('images', 'filename.jpg');
        $path = $request->photo->storeAs('images', 'filename.jpg', 's3');

        //存储上传的文件
        $fileName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $extension;
        Storage::disk('upload')->put($fileName,file_get_contents($path));
    }

    public function test(Request $request){
//        文件上传
//配置config/filesystems.php
//增加以下配置
//'uploads'=>[
//            'driver'=> 'local',
//            'root'=>storage_path('app/uploads')  //位于storage/app/uploads
//            //public_path('app/uploads') //则位于public/app/uploads
//        ],

//定义路由，创建视图，模板文件的form post提交，记得加上enctype="multipart/form-data" 属性
//同时记得带上token {{ csrf_field() }}  <input type="file" name="avatar" />

//接收处理
        $file = $request->file('avatar');
        if ($file->isValid()) { //判断文件是否上传成功
            $originalName = $file->getClientOriginalName(); //原文件名
            $ext = $file->getClientOriginalExtension(); //扩展名 不含.
            $type = $file->getClientMimeType(); //MimeType
            $realPath = $file->getRealPath(); //临时绝对路径
            // 这里可以根据 扩展名和MimeType对文件进行验证
            $fileName = md5_file($realPath) . '.' . $ext;
            $res = Storage::disk('uploads')->put($fileName, file_get_contents($realPath)); //返回布尔值
        }
    }
}
