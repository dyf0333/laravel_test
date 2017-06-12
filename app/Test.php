<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8 0008
 * Time: 12:06
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    protected $table = 'Test';
//    protected $primaryKey = 'id';
    public $timestamps = false;//该模型是否被自动维护时间戳
//    protected $dateFormat = 'U';//模型的日期字段保存格式
//    protected $connection = 'connection-name'; //链接名称
    use SoftDeletes; //软删除

    /**
     * 一对一关联
     */
    public function User(){
        return $this->hasOne('User');
    }

    /**
     * 反向关联 （一对一）
     */
    public function UserTemp(){
        return $this->belongsTo('User');
    }

    /**
     * 一对多
     */
    public function comments()
    {
        return $this->hasMany('Comment');
    }

    /**
     * 多对多
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}