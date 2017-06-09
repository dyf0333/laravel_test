<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        //存储上传的文件
        //store 方法允许存储文件到相对于文件系统根目录配置的路径。这个路径不能包含文件名，名称将使用 MD5 散列文件内容自动生成。
        //store 方法还接受一个可选的第二个参数，用于文件存储到磁盘的名称。这个方法会返回文件相对于磁盘根目录的路径：
        $path = $request->photo->store('images');
        $path = $request->photo->store('images', 's3');
        $path = $request->photo->storeAs('images', 'filename.jpg');
        $path = $request->photo->storeAs('images', 'filename.jpg', 's3');
    }
}
