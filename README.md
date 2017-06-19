# laravel_test
学习laravel框架
https://docs.golaravel.com/docs/5.4/installation/

php版本 7.1.4
<br>
laravel 5.4.25
<br>


维护模式的开启与关闭

    php artisan down
    php artisan up
       
2017.6.8

    路由
    中间件
    CSRF
    
2017.6.9

    单一操作（控制器）
    在控制器的构造方法里创建中间件
    资源路由
    依赖注入
      构造函数注入
      方法注入
    路由缓存
      基于闭包的路由并不能被缓存。如果要使用路由缓存，你必须将所有的闭包路由转换成控制器类
    响应
      重定向
      session（闪存）
      表单验证

2017.6.12
    
    用户认证
        php artisan make:auth
        php artisan migrate
    http认证
    API认证
        Passport 基于 League OAuth2 server 实现
    用户授权系统
         Gates (像 路由)提供了一个简单、基于闭包的方式来授权认证。
         策略（像 控制器）在特定的模型或者资源中通过分组来实现授权认证的逻辑。
    laravel提供的encrypt与decrypt加密解密
         OpenSSL 提供的 AES-256 和 AES-128 的加密
    php artisan 命令行
    广播
    缓存
    辅助函数
    数据库
        查询构造器、分页、数据填充
    Eloquent
        关联模型（一对一、一对多、多对多）
        Eloquent集合
        
2017.6.15
    
    send Email
    队列发送（数据库方式，多种方式可切换）
    Log
    表单（包括validate验证、控制器、view）
    cache缓存（多种方式切换）
    上传文件并保存功能
    各种功能的门面facade方法
    
2017.6.19
    
    Redis做缓存、session、队列
       如果缓存使用Redis，session也使用了Redis，队列已使用了Redis，
       当运行php artisan cache:clear清除缓存时，会把登录信息清除，也会把队列清除
       解决办法很简单，为它们分配不同的连接即可。在config\database.php中增加连接，注意database序号
       然后分别为session和queue更换连接，
       //session.php中的connection选项：
       //queue.php中的connections数组中：

    