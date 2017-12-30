<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>@yield('title')</title>
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
