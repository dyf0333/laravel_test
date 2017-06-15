<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){
        Mail::raw('邮件内容 测试',function ($message){
            $message->form('发件人邮件地址','发件人');
            $message->subject('邮件主题');
            $message->to('给谁');

            Mail::send('mail test', ['name'=>'dyf'],function ($message){
                $message->to('给谁');
            });
        });
    }
}
