<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ViewController extends Controller
{
    public function index(){
        $viewName = 'welcome';
        if (View::exists($viewName)) {
            echo $viewName . '模板存在';
        }else{
            echo $viewName . '模板不存在';
        }
        return view('view',['name' => 'view']);
//        return view('view')->with(['name' => 'view']);
    }
}
