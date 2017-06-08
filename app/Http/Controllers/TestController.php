<?php

namespace App\Http\Controllers;

use App\Dyf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index(){
        $userModel= new Dyf();
        $temp = $userModel->all();
//        dd($temp);

        $res = DB::select('select * from dyf');
        dd($res);
        die;
    }
}
