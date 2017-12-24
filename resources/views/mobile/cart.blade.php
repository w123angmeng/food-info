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
                                <a class="nav-submenu" data-toggle="nav-submenu" href="{{"/order"}}">
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
                            <h3>购物车
                                <a href="#" class="btn btn-primary pull-right" role="button">确认提交</a>
                                <span class="pull-right" style="color: red;font-size: 16px;">
                                    共
                                    <span id="total_num">{{$total_num}}</span>
                                    件
                                    &nbsp;&nbsp;
                                    共
                                    <span id="total_price">{{$total_price}}</span>
                                    元
                                </span>
                            </h3>
                        </div>
                        <div class="main_content" style="height:auto;padding-top: 15px;">

                            <div class="row">
                                @foreach ($result as $r)
                                    <div class="col-sm-6 col-md-3" style="padding-left:0;">
                                        <div class="thumbnail" style="height:auto;">
                                            <input name="id" type="hidden" value="{{$r->t_id}}">
                                            <img alt="100%x180" data-src="holder.js/100%x180" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMzE5IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDMxOSAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVhM2ZkOTk0MjYgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxNnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWEzZmQ5OTQyNiI+PHJlY3Qgd2lkdGg9IjMxOSIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMTcuOTg0Mzc1IiB5PSIxMDcuMiI+MzE5eDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
                                            <div class="caption">
                                                <h5>{{$r->name}}</h5>
                                                <p><span>价格：{{$r->price}}</span><span>  数量：{{$r->num}}</span></p>
                                                <p><a href="#" class="btn btn-primary btn_Add" role="button">删除</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <script type="application/javascript">
                        $(".btn_Add").click(function(e){
                            var id = $(e.target).closest(".thumbnail").find("input[name='id']").val();
                            $.ajax({
                                type:"GET",
                                url:"{{ url('cart/del') }}"+"/"+id,
                                success:function(data){
                                    if(data.status == 1){
                                        alert(data.info);
                                        location.href = "{{url("/cart")}}";
                                        //$("#total_num").text(data.total_num);
                                        //$("#total_price").text(data.total_price);
                                    }else{
                                        alert(data.info);
                                    }

                                }
                            });
                        });
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
