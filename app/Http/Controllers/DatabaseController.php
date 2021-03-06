<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{

    /**
     * DBfacade的方法下的
     * 原生sql语句执行
     */
    public function index(){
        //DB facade 的 select 方法
        //参数绑定可以避免 SQL 注入攻击
        $users = DB::select('select * from users where active = ?', [1]);
        $results = DB::select('select * from users where id = :id', ['id' => 1]);

        DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
        $affected = DB::update('update users set votes = 100 where name = ?', ['John']);
        $deleted = DB::delete('delete from users');
    }

    /**
     * DB Facade的
     * 事务
     */
    public function transaction(){
        DB::transaction(function () {
            DB::table('users')->update(['votes' => 1]);
            DB::table('posts')->delete();
        });


        DB::beginTransaction();
        DB::rollBack();
        DB::commit();
    }

    public function normal(){
        $users = DB::table('users')->get();
        $user = DB::table('users')->where('name', 'John')->first();
        $email = DB::table('users')->where('name', 'John')->value('email');

        $titles = DB::table('roles')->pluck('title');
        $roles = DB::table('roles')->pluck('title', 'name');

        //分块处理
        DB::table('users')->orderBy('id')->chunk(100, function ($users) {
            foreach ($users as $user) {}
        });
        DB::table('users')->orderBy('id')->chunk(100, function ($users) {
            return false;//停止后续分块行为
        });

        //聚合
        $users = DB::table('users')->count();
        $price = DB::table('orders')->max('price');
        $price = DB::table('orders')->min('price');
        $price = DB::table('orders')->sum('price');
        $price = DB::table('orders')->where('finalized', 1)->avg('price');

        //查询
        $users = DB::table('users')->select('name', 'email as user_email')->get();
        //distinct 方法允许你强制让查询返回不重复的结果：
        $users = DB::table('users')->distinct()->get();
        $query = DB::table('users')->select('name');
        $users = $query->addSelect('age')->get();

        //原始写法，防止注入
        $users = DB::table('users')
            ->select(DB::raw('count(*) as user_count, status'))
            ->where('status', '<>', 1)
            ->groupBy('status')
            ->get();

        //join连接多表
        $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();
        $users = DB::table('sizes')
            ->crossJoin('colours')
            ->get();
        DB::table('users')
            ->join('contacts', function ($join) {
                $join->on('users.id', '=', 'contacts.user_id')->orOn(...);
            })->get();
        DB::table('users')
            ->join('contacts', function ($join) {
                $join->on('users.id', '=', 'contacts.user_id')
                    ->where('contacts.user_id', '>', 5);
            })
            ->get();

        //union
        $first = DB::table('users')
            ->whereNull('first_name');
        $users = DB::table('users')
            ->whereNull('last_name')
            ->union($first)
            ->get();


        //findOrFail 以及 firstOrFail 方法会取回查询的第一个结果
        $model = User::findOrFail(1);
        $model = User::where('legs', '>', 100)->firstOrFail();

        //包含软删除的数据
        $flights = User::withTrashed()->where('account_id', 1)->get();
        $flights->history()->withTrashed()->get();

        $Users = User::onlyTrashed()->where('airline_id', 1)->get();

        User::withTrashed()->where('airline_id', 1)->restore();
        $flights->history()->restore();


        // 强制删除单个模型实例...
        $flights->forceDelete();
        // 强制删除所有相关模型...
        $flights->history()->forceDelete();

        //只获取一个字段的数据，相当于thinkphp 的field
        $names = DB::table('User')->pluck('name');
        $names = DB::table('User')->lists('name');
        //lists可以指定lists的第二个参数为返回数据的键下标 array_column()
        $names = DB::table('User')->lists('name','id');
        //只获取某些字段的数据，相当于thinkphp 的field
        $names = DB::table('User')->select('id','name','age');

    }

    public function where(){
        $users = DB::table('users')->where('votes', '=', 100)->get();
        $users = DB::table('users')->whereRaw('votes >= ? and age > ?', [10,20])->get(); //多个where条件
        $users = DB::table('users')
            ->where('votes', '>=', 100)
            ->get();
        $users = DB::table('users')
            ->where('votes', '<>', 100)
            ->get();

        $users = DB::table('users')
            ->where('name', 'like', 'T%')
            ->get();
        $users = DB::table('users')->where([
            ['status', '=', '1'],
            ['subscribed', '<>', '1'],
        ])->get();

        $users = DB::table('users')
            ->where('votes', '>', 100)
            ->orWhere('name', 'John')
            ->get();

        //嵌套查询
        DB::table('users')
            ->where('name', '=', 'John')
            ->orWhere(function ($query) {
                $query->where('votes', '>', 100)
                    ->where('title', '<>', 'Admin');
            })
            ->get();
    }

    public function lock(){
        //共享锁
        DB::table('users')->where('votes', '>', 100)->sharedLock()->get();
        //「更新」锁可避免行被其它共享锁修改或选取
        DB::table('users')->where('votes', '>', 100)->lockForUpdate()->get();

    }

    /**
     * 分页
     */
    public function page(){
        //调用 paginate 方法的时候，你将会接收到一个 Illuminate\Pagination\LengthAwarePaginator 实例
        //调用 simplePaginate 方法时，你将会接收到一个 Illuminate\Pagination\Paginator 实例

        $users = DB::table('users')->paginate(15);
        $users = DB::table('users')->simplePaginate(15);

        $users = User::paginate(15);
        $users = User::where('votes', '>', 100)->paginate(15);
        $users = User::where('votes', '>', 100)->simplePaginate(15);

        //分页的blade页面渲染
//        <div class="container">
//        @foreach ($users as $user)
//            {{ $user->name }}
//        @endforeach
//        </div>
//        {{ $users->links() }}
//        {{ $users->render() }}

        $users->count();
        $users->currentPage();
        $users->firstItem();
        $users->hasMorePages();
        $users->lastItem();
        $users->lastPage(); //(当使用 simplePagination 时无效)
        $users->nextPageUrl();
        $users->perPage();
        $users->previousPageUrl();
        $users->total(); //(当使用 simplePagination 时无效);
//        $users->url($page);


        DB::table('User')->chunk(10,function ($users){
            dd($users);
            if(1){//查询够了的条件
                return false;//在此次停止
            }
        });
    }

    /**
     * Eloquent ORM 学习
     */
    public function orm1(){
        //all 方法，返回的是所有数据的集合
        $users = User::all();

        //find 方法， 返回一条数据
        $users = User::find(1);

        //findOrFail 根据主键查找，如果没查到，就报错
        $users = User::findOrFail(1);

        User::chunk(10,function ($users){
            dd($users);
            if(1){//查询够了的条件
                return false;//在此次停止
            }
        });

        User::count();
        User::where('id','>','100')->max('age');

        //用created方法新增数据
        User::create([
            'name'=>'temp1',
            'age'=>'11',
            ]);

        //如果没有就创建一条数据
        User::firstOrCreate([
            'name'=>'temp1',
        ]);

        //如果没有就创建一条实例，如果要保存，用save方法
        $user = User::firstOrNew([
            'name'=>'temp1',
        ]);
        $user->save();


        //更新数据
        $user = User::find(1);
        $user->name = '11';
        $user->save();

        $num = User::where('id','>','1')->update(['age'=>41]);

        //删除数据
        User::destroy(1);
        User::destroy(1,2,3,4);
        User::destroy([1,2,3,4]);
        User::where('id','>','1')->delete();
    }
}
