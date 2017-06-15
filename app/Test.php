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

/**
 * Eloquent ORM 学习
 */
class Test extends Model
{

    protected $table = 'Test';
//    protected $primaryKey = 'id';
    public $timestamps = false;//该模型是否被自动维护时间戳
//    protected $dateFormat = 'U';//模型的日期字段保存格式
//    protected $connection = 'connection-name'; //链接名称
    use SoftDeletes; //软删除

    //laravel 的默认时间字段是 create_at 、 update_at 、delete_at
    //写入表的时候，写入时间戳
    protected function getDateFormat()
    {
        return time();
    }
    //从数据库取出时间数据时候，不直接转成string形式
    protected function asDateTime($val)
    {
        return $val;
    }


    //create默认不允许批量赋值
    //允许制定批量赋值的字段
    protected $fillable = ['name','age'];
    //允许制定批量赋值的字段
    protected $guarded = ['sex','money'];

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