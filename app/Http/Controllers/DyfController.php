<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/9 0009
 * Time: 17:09
 */

namespace App\Http\Controllers;


use App\Console\Commands\Inspire;
use App\Dyf;
use App\User;
use Dotenv\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DyfController extends Controller
{
    public function index(){
        echo 'index';
    }
    public function dyf(){
        echo 'dyf';
    }

    public function pdo(){
        phpinfo();
        echo 'pdo';die;
        $userModel= new Dyf();
        $temp = $userModel->all();
        dd($temp);
        die;



        $pdo = DB::connection()->getPdo();
//        $pdo = DB::connection()->getPdo();
        dd($pdo);
        die;

        $input = Input::all();

        $rules = [
            'password'=>'required|between:6,20|confirmed',
        ];
        $message = [
            'password.required'=>'密码不能为空',
            'password.between'=>'密码需在6-20位之间',
            'password.confirmed'=>'新旧密码需一致', //form里确认密码字段需改成 password_confirm
        ];
        Validator::make($input,$rules,$message);
    }

}