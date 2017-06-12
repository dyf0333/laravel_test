<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 确认密码字段最少必须 60 字符长。保持字段原定的 255 字符长是个好选择
 * users 数据表中必须含有 nullable 、100 字符长的 remember_token 字段。
 * 当用户登录应用并勾选「记住我」时，这个字段将会被用来保存「记住我」 session 的令牌。
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
