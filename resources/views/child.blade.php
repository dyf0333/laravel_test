@extends('layout.app')

@section('title', 'Page Title')

@section('sidebar')
    @@parent

    {{--引入子视图--}}
    @include('shared.errors')
    @include('view.name', ['some' => 'data'])
    @includeIf('view.name', ['some' => 'data'])


    <p>This is appended to the master sidebar.</p>
    {{ isset($name) ? $name : 'Default' }}
    {{ $name or 'Default' }}

    {{--在默认情况下，Blade 模板中的 {{ }} 表达式将会自动调用 PHP htmlspecialchars 函数来转义数据以避免 XSS 的攻击。
    如果你不想你的数据被转义，你可以使用下面的语法：--}}
    Hello, {!! $name !!}.


    @if (count($records) === 1)
        我有一条记录！
    @elseif (count($records) > 1)
        我有多条记录！
    @else
        我没有任何记录！
    @endif

    @unless (Auth::check())
        你尚未登录。
    @endunless

    @for ($i = 0; $i < 10; $i++)
        目前的值为 {{ $i }}
    @endfor

    @foreach ($users as $user)
        <p>此用户为 {{ $user->id }}</p>
    @endforeach

    @forelse ($users as $user)
        <li>{{ $user->name }}</li>
    @empty
        <p>没有用户</p>
    @endforelse

    @while (true)
        <p>我永远都在跑循环。</p>
    @endwhile


    @foreach ($users as $user)
        @if ($user->type == 1)
            @continue
        @endif

        <li>{{ $user->name }}</li>

        @if ($user->number == 5)
            @break
        @endif
    @endforeach


    @foreach ($users as $user)
        @continue($user->type == 1)

        <li>{{ $user->name }}</li>

        @break($user->number == 5)
    @endforeach


    @foreach ($users as $user)
        @if ($loop->first)
            This is the first iteration.
        @endif

        @if ($loop->last)
            This is the last iteration.
        @endif

        <p>This is user {{ $user->id }}</p>
    @endforeach



    @foreach ($users as $user)
        @foreach ($user->posts as $post)
            @if ($loop->parent->first)
                This is first iteration of the parent loop.
            @endif
        @endforeach
    @endforeach


@endsection

@section('content')
    <p>This is my body content.</p>
@endsection