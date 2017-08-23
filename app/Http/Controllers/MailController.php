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


//        需要在.env 配置MAIL 相关的参数，（163邮箱的请记得不是密码，而是授权码）
//发送文本邮件

        Mail::raw('邮件内容详情', function($message){
    $message->to("收件人邮箱地址");
            $message->from("发件人邮箱", "发件人姓名"); //发件人邮箱必须和验证邮箱一样 非必填
            $message->subject("邮件主题");
        });

//发送带格式的邮件
        Mail::send('notify.mail', ['key' => 'value'], function ($message) {
            $message->to("收件人邮箱地址");
            $message->from("发件人邮箱", "发件人姓名"); //发件人邮箱必须和验证邮箱一样 非必填
            $message->subject("邮件主题");
        });
//notify.mail wei  views/notify/mail.blade.php 模板文件
//key=>value 跟 return view() 的第二个参数一样

    }
}
