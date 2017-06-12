<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * 自动生成用户权限验证代码
 * php artisan make:auth
 * php artisan migrate
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
