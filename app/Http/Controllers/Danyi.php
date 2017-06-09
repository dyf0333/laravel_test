<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;



class Danyi extends Controller
{
    /**
     * 为单一操作控制器注册路由时，无需指定方法：
     * @param  int  $id
     * @return Response
     */
    public function __invoke($id)
    {
        echo $id;
//        return view('user', ['user' => User::findOrFail($id)]);
    }
}
