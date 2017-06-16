# blade模板的文档

## 父子模板有两种继承实现方式 @yield 和 @section

### 方式一：


父模板：

    @yield('content')


子模板：

    @section('content')
    Content here
    @stop

### 方式二：

父模板

    @section('content')
    @show

子模板：

    @section('content')
    Content here
    @parent @stop
<br>

### 区别
    @yield() 
    可以理解为一个占位符。
    是不可扩展的

and

    @section('head') 
    表示一个存储区域，这个区域内父模板可以预定义内容，在子模板中可以通过 @parent 进行调用。
    则既可以被替代，又可以被扩展
    
# #@section 可以用@show, @stop, @overwrite 以及 @append 来结束
    
    @show 与 @stop
    @show 指的是执行到此处时将该 section 中的内容输出到页面，而 @stop 则只是进行内容解析，并且不再处理当前模板中后续对该section的处理，除非用 @override覆盖。
    通常来说，在首次定义某个 section 的时候，应该用 @show，而在替换它或者扩展它的时候，不应该用 @show，应该用 @stop。
    
and

    @append 和 @override
    定义的每一个 section ，在随后的子模板中其实是可以多次出现的
    关键就在于 @append 这个关键字，它表明“此处的内容添加到”，因此内容会不断扩展。而最后用了 @stop，表示这个 section 的处理到此为止。如果在后面继续用 @append 或者 @stop 来指定这个 section 的内容，都不会生效。除非用 @override 来处理。 @override 的意思就是“覆盖之前的所有定义，以这次的为准”。
