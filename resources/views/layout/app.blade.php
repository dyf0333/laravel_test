<html>
<head>
    <title>应用程序名称 - @yield('title')</title>

    {{--加载cdn上的资源--}}
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    {{--加载本服务上的静态资源--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

</head>
<body>
@section('sidebar')
    这是 app 的 master 的侧边栏。
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>