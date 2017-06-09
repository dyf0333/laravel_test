<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(){

    }

    /**
     * 注入的方式获取session数据
     */
    public function show(Request $request, $id)
    {
        $value = $request->session()->get('key');

        //get session
        $data = $request->session()->all();
        if ($request->session()->has('users')) {
            //使用 has 方法检查某个值是否存在于 Session 内，如果该值存在并且不为 null，那么则返回 true：
        }
        if ($request->session()->exists('users')) {
            //在判断值是否在 Session 中是否存时，如果该值可能为 null，你需要使用 exists 方法，如果该值存在，那么则返回 true：
        }

        //set session
        $request->session()->put('key', 'value');
        session(['key' => 'value']);

        //闪存，只有下一次http请求有效
        $request->session()->flash('status', 'Task was successful!');

        //删除缓存
        $request->session()->forget('key');
        $request->session()->flush();

        //重新生成session_id
        //防止恶意用户利用 session fixation 对应用进行攻击
        $request->session()->regenerate();
    }
}
