<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * 1.http request类的session 方法
 * 2.session辅助函数
 * 3.Session facade方法
 */
class SessionController extends Controller
{

    /**
     * 构造函数，不能获取到session数据；具体原因在
     *      https://github.com/dyf0333/document/blob/master/Laravel%E7%9A%84%E5%9D%91.md
     * 所以这里处理session数据，而不做任何权限判断；只将session数据保存起来，以供继承于本控制器的其他子类用
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $sessionInfo = Session::get(AdminService::SESSION_KEY);
            if ($sessionInfo) {
                $this->merchantId = $sessionInfo['merchant_id'];
                $this->accountId = $sessionInfo['id'];
                $this->accountInfo = $sessionInfo;
            }
            return $next($request);
        });
    }


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

        //session的facade方法
        Session::put('key1','value1');
        Session::get('key1');
        Session::get('key1','default');

        //获取数据
        Session::push('key1','value1');
        //获取获取并删除数据
        Session::pull('key1','default');
        //获取所有数据
        Seesion::all();

        //删除session数据
        Session::forget('key');
        //删除session所有数据
        Session::flush();

    }
}
