<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/css/swiper.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script src="/js/jquery.min.js" type="application/javascript"></script>
        <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/js/swiper.min.js" type="application/javascript"></script>
        <script src="//cdn.bootcss.com/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            /*.links > a {*/
                /*color: #636b6f;*/
                /*padding: 0 25px;*/
                /*font-size: 12px;*/
                /*font-weight: 600;*/
                /*letter-spacing: .1rem;*/
                /*text-decoration: none;*/
                /*text-transform: uppercase;*/
            /*}*/

            .m-b-md {
                margin-bottom: 30px;
            }
            .side-content{
                padding:30px 0;
            }
            .side-content>.nav-main>li {
                height:40px;
                line-height: 40px;
                list-style-type: none;
            }
            .side-content>.nav-main>.header{
                color:#555;
                font-size:16px;
                height:50px;
                line-height: 50px;
            }
        </style>
    </head>
    <body>
        <div class="container" style="padding:0;height:52px;border: solid 1px grey">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            <img alt="Brand" height="20px" src="/images/photo.jpg" width="40px">
                        </a>
                    </div>
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            食品安全资讯网站
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-7">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{url("/")}}">首页</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-2" style="height:700px;border: solid 1px grey">
                    <div class="side-content">
                        <ul class="nav-main">
                            <li class="header" id="shop">
                                <span class="sidebar-mini-hide">首页</span>
                            </li>
                            <li class="open" id="shop">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/goods"}}">
                                    <span class="sidebar-mini-hide">商品列表</span>
                                </a>
                            </li>
                            <li class="open" id="shop">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/order/list"}}">
                                    <span class="sidebar-mini-hide">我的订单</span>
                                </a>
                            </li>
                            <li class="open" id="shop">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/cart"}}">
                                    <span class="sidebar-mini-hide">我的购物车</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-10" style="height:700px;padding-right:0;">
                    <div class="main" style="border: solid 1px grey;padding:0 20px;">
                        <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
                            <h3>我的订单</h3>
                        </div>
                        <div class="main_content" style="height:650px;padding-top: 15px;">
                            <div class="panel panel-primary">
                                <div class="panel-heading">订单列表</div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>订单号</th>
                                            <th>商品信息</th>
                                            <th>总数量</th>
                                            <th>总金额</th>
                                            <th>下单人</th>
                                            <th>下单时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($result as $r)
                                            <tr>
                                                <th scope="row">{{ $r->order_no }}</th>
                                                <td>
                                                    <table class="table table-bordered">
                                                    <tbody>
                                                        @foreach($result_g[$r->id] as $g)
                                                        <tr>
                                                            <td>{{$g->goods_name}}</td>
                                                            <td>{{$g->goods_price}}元</td>
                                                            <td>{{$g->goods_num}}{{$g->goods_unit}}</td>
                                                            <td>{{$g->total_price}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    </table>
                                                </td>
                                                <th>{{ $r->total_num }}</th>
                                                <td>{{ $r->total_price }}</td>
                                                <td>{{ $r->username }}</td>
                                                <td>{{ $r->oper_time }}</td>
                                                <td>
                                                    <a id="btn_del" href="{{"/order/del/$r->id"}}" class="btn btn-default btn-sm" title="删除"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="application/javascript">
                        $("#btn_submit").click(function(){
                            var title = $("input[name='title']").val();
                            var thumb = $("input[name='thumb']").val();
                            var content = $("input[name='content']").val();
                            if(title == ""){
                                $("#tip_title").text("文章标题不能为空！");
                                return false;
                            }
                            if(thumb == ""){
                                $("#tip_thumb").text("索引图片不能为空！");
                                return false;
                            }
                            if(content == ""){
                                $("#tip_content").text("文章内容不能为空！");
                                return false;
                            }
                            $.ajax({
                                type:"POST",
                                url:"/"+"{{Request::path()}}",
                                data:{
                                    title:title,
                                    thumb:thumb,
                                    content:content,
                                    state:$("input:radio[name='state']:checked").val()
                                },
                                success:function(data){
                                    if(data.status == 1){
                                        alert(data.info);
                                        location.href = "{{url("/article")}}";
                                    }else{
                                        alert(data.info);
                                    }

                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            //等价form表单中：<input type="hidden" name="_token" value="">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function () {
                var mySwiper = new Swiper ('.swiper-container', {
                    direction: 'horizontal',
                    loop: true,

                    // 如果需要分页器
                    pagination: '.swiper-pagination',

                    // 如果需要前进后退按钮
                    nextButton: '.swiper-button-next',
                    prevButton: '.swiper-button-prev',

                    // 如果需要滚动条
                    scrollbar: '.swiper-scrollbar',
                })
            });
            $("#login").click(function(){
                $("#login_container").css("display","block");
                $("#cover_main_container").css("display","block");
                $("#close_login_container").click(function(){
                    $("#login_container").css("display","none");
                    $("#cover_main_container").css("display","none");
                });
            });
            $("#btn_login").click(function(){
                var username = $("input[name='username']").val();
                var password = $("input[name='password']").val();
                if(username == "" || password == ""){
                    $("#tip_login").text("用户名或密码不能为空！");
                    return false;
                }
                $.ajax({
                    type:"GET",
                    url:"/",
                    data:{
                        username:username,
                        password:password
                    },
                    success:function(){
                        alert("success!");
                    },
                    error:function () {
                        alert("error!");
                    }
                });
            });
        </script>
    </body>
</html>
