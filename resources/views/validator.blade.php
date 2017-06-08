<!doctype html>
<head>
    <title>Laravel Validator Test</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
            <form action="{{url('testValidate')}}" method="POST">
                {{csrf_field()}}

                {{--运用_method方法告知form请求方式--}}
                {{--<input type="hidden" name="_method" value="PUT">--}}
                {{--或--}}
                {{--{{ method_field('PUT') }}--}}

                <legend style="text-align: center">表单提交</legend>

                <label>Name</label>
                <input type="text" name="name">
                <hr>

                <label>Age</label>
                <input type="text" name="age">
                <hr>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
    </div>
</div>

<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>