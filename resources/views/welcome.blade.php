<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>HIS官网</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/css/swiper.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script src="/js/jquery.min.js" type="application/javascript"></script>
        <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/js/swiper.min.js" type="application/javascript"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family:"微软雅黑";
                font-size:14px;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            div p{
                margin:0 0;
            }
            body>div{
                width: 1200px;
                margin:0 0;
            }
            div.logo{
                height:90px;
                line-height: 90px;
            }
            div.nav{
                width:100%;
                border:1px solid #636b6f;
            }
            div.main>div.square-part{
                margin-top: 25px;
                height:200px;
            }
            div.main>div.square-part>div.square-item{
                border:1px solid #636b6f;
            }
            div.main>div.square-part:first-child{
                /*background-color: pink;*/
            }
            div.main>div.square-part:last-child{
                /*background-color: pink;*/
            }
            div.main>div.square-part>div.square-item>p.item-icon{
                height:140px;
                line-height: 140px;
                text-align: center;
            }
            div.main>div.square-part>div.square-item>p.item-icon>img{
                margin:auto auto;
                vertical-align: center;
            }

            div.main>div.square-part>div.square-item>p.item-name{
                height:60px;
                line-height: 60px;
                text-align: center;
                font-size:16px;
            }


            div.main>div.expert-part{
                margin-top: 25px;
            }
            div.main>div.expert-part>div.expert-item{
                padding:10px;
            }
            div.main>div.expert-part>div.expert-item>div.expert-img{
                height:180px;
                width:100%;
                text-align: center;
                border-left:1px solid darkgray;
                border-right: 1px solid darkgray;
                border-top: 1px solid darkgray;
            }
            div.main>div.expert-part>div.expert-item>div.expert-info{
                height:60px;
                line-height: 30px;
                text-align: center;
                border-left:1px solid darkgray;
                border-right: 1px solid darkgray;
                border-bottom: 1px solid darkgray;
            }
            div.main>div.expert-part>div.expert-item>div.expert-info>p.expert-name{
                font-size: 18px;
                font-weight: bold;
            }


            div.main>div.goods-part{
                margin-top: 25px;
            }
            div.main>div.goods-part>div.goods-item{
                padding:10px;
            }
            div.main>div.goods-part>div.goods-item>div.goods-img{
                height:180px;
                width:100%;
                text-align: center;
                border-left:1px solid darkgray;
                border-right: 1px solid darkgray;
                border-top: 1px solid darkgray;
            }
            div.main>div.goods-part>div.goods-item>div.goods-info{
                height:60px;
                line-height: 30px;
                padding-left: 30px;
                border-left:1px solid darkgray;
                border-right: 1px solid darkgray;
                border-bottom: 1px solid darkgray;
            }
            div.main>div.goods-part>div.goods-item>div.goods-info{
                font-size: 18px;
                font-weight: bold;
            }
            div.main>div.goods-part>div.goods-item>div.goods-info>p>span.goods-price{
                font-size: 20px;
                font-weight: bold;
                color: darkorange;
            }

             div.news-info{
                 padding:10px;
             }
            div.news-info>div.news-img{
                height:120px;
                border-left:1px solid darkgray;
                border-right: 1px solid darkgray;
                border-top: 1px solid darkgray;
            }
            div.news-info>div.news-list{
                line-height: 30px;
                padding-left:30px;
                border-left:1px solid darkgray;
                border-right: 1px solid darkgray;
                border-bottom: 1px solid darkgray;
            }

            div.main>div.head-text{
                height:50px;
                line-height: 50px;
                margin-top:25px;
                padding-left:10px;
            }
            div.head-text>div.little-rectangle{
                width:12px;
                height:50px;
                background-color: #007d5b;
                display: inline-block;
            }
            div.head-text>div.head-info{
                line-height: 25px;
                margin-left:5px;
                display: inline-block;
            }
            div.footer{
                width:100%;
                background-color: black;
            }
            div.footer>div.footer-content {
                width: 1200px;
                margin:0 auto;

            }
            /*
            li.active{
                background-color: #016549;
                color: white;
                font-size: 16px;
            }
            ul{
                background-color: #017e5c;color:white;
            }
            */
        </style>
    </head>
    <body>
        <div class="container logo">
            <div class="row">
                <div class="col-md-8 logo-left pull-left">
                    <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/logo.png" width="50px" height="50px" style="display: inline-block">
                    <span>青岛圣林源老年病医院</span>
                </div>
                <div class="col-md-4 logo-right pull-right">
                    <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/phone_white.png" width="30px" height="30px" style="display: inline-block">
                    <span>联系电话：0936-6732529</span>
                </div>
            </div>
        </div>
        <div class="container menu">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#">主页</a></li>
                <li role="presentation"><a href="#">专家团队</a></li>
                <li role="presentation"><a href="#">特色科室</a></li>
            </ul>
        </div>
        <div class="container nav">
            <div class="swiper-container" style="height:300px;">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/nav.png" width="100%">
                        <!--<div class="inner">
                            <div id="mainTheme"><h1>Swiper</h1><span>3</span></div>
                            <p data-swiper-parallax="-1500" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">开源、免费、强大的移动端触摸滑动插件</p>
                            <div class="subbtn" data-swiper-parallax="-3000" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                <a class="button" href="/demo/index.html">查看Swiper演示</a>  <a class="button" href="/api/index.html">查看API 文档</a>  <a class="button" href="http://bbs.swiper.com.cn" target="_blank">交流、分享Swiper</a>  <a class="button" href="http://swiper2.swiper.com.cn" target="_blank">回顾Swiper2</a></div>
                            <div class="mainbtn" data-swiper-parallax="-4500" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                <a href="/usage/index.html">开始使用 Swiper</a></div>
                        </div>-->
                    </div>
                    <div class="swiper-slide">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/nav.png" width="100%">
                    </div>
                    <div class="swiper-slide">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/nav.png" width="100%">
                    </div>
                </div>
                <!-- 如果需要分页器 -->
            {{--<div class="swiper-pagination"></div>--}}

            <!-- 如果需要导航按钮 -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- 如果需要滚动条 -->
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
        <div class="container main">
            <div class="row square-part">
                <div class="col-md-2"></div>
                <div class="col-md-2 square-item" style="background-color: #5f9889;">
                    <p class="item-icon">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/search_icon.png" width="120px" height="120px">
                    </p>
                    <p class="item-name">报告查询</p>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2 square-item" style="background-color: #d59057;">
                    <p class="item-icon">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/reg_icon.png" width="120px" height="120px">
                    </p>
                    <p class="item-name">挂号指南</p>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2 square-item" style="background-color: #a4adcc;">
                    <p class="item-icon">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/server_icon.png" width="120px" height="120px">
                    </p>
                    <p class="item-name">服务指南</p>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row head-text">
                <div class="little-rectangle">
                </div>
                <div class="head-info">
                    <p class="head-name">专家团队</p>
                    <p class="head-sub-name">Expert Team</p>
                </div>
            </div>
            <div class="row expert-part">
                <div class="col-md-4  expert-item">
                    <div class="expert-img">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/expert_min.png" width="100%" height="100%">
                    </div>
                    <div class="expert-info">
                        <p class="expert-name">Peter &nbsp;&nbsp;<span>主任医生</span></p>
                        <p>心脑血管专家</p>
                    </div>
                </div>
                <div class="col-md-4  expert-item">
                    <div class="expert-img">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/expert_min.png" width="100%" height="100%">
                    </div>
                    <div class="expert-info">
                        <p class="expert-name">Peter &nbsp;&nbsp;<span>主任医生</span></p>
                        <p>心脑血管专家</p>
                    </div>
                </div>
                <div class="col-md-4  expert-item">
                    <div class="expert-img">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/expert_min.png" width="100%" height="100%">
                    </div>
                    <div class="expert-info">
                        <p class="expert-name">Peter &nbsp;&nbsp;<span>主任医生</span></p>
                        <p>心脑血管专家</p>
                    </div>
                </div>
            </div>
            <div class="row head-text">
                <div class="little-rectangle">
                </div>
                <div class="head-info">
                    <p class="head-name">特色科室</p>
                    <p class="head-sub-name">Expert Team</p>
                </div>
            </div>
            <div class="row head-text">
                <div class="little-rectangle">
                </div>
                <div class="head-info">
                    <p class="head-name">健康体检</p>
                    <p class="head-sub-name">Expert Team</p>
                </div>
            </div>
            <div class="row goods-part">
                <div class="col-md-4  goods-item">
                    <div class="goods-img">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/package_min.png" width="100%" height="100%">
                    </div>
                    <div class="goods-info">
                        <p class="goods-name">体检套餐</p>
                        <p>青岛圣林源医院 &nbsp;&nbsp;<span class="goods-price">￥2800</span></p>
                    </div>
                </div>
                <div class="col-md-4  goods-item">
                    <div class="goods-img">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/package_min.png" width="100%" height="100%">
                    </div>
                    <div class="goods-info">
                        <p class="goods-name">体检套餐</p>
                        <p>青岛圣林源医院 &nbsp;&nbsp;<span class="goods-price">￥2800</span></p>
                    </div>
                </div>
                <div class="col-md-4  goods-item">
                    <div class="goods-img">
                        <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/package_min.png" width="100%" height="100%">
                    </div>
                    <div class="goods-info">
                        <p class="goods-name">体检套餐</p>
                        <p>青岛圣林源医院 &nbsp;&nbsp;<span class="goods-price">￥2800</span></p>
                    </div>
                </div>
            </div>

            <div class="row news-part">
                <div class="col-md-6 left-news">
                    <div class="row head-text">
                        <div class="little-rectangle">
                        </div>
                        <div class="head-info">
                            <p class="head-name">医院动态</p>
                            <p class="head-sub-name">Expert Team</p>
                        </div>
                    </div>

                    <div class="news-info">
                        <div class="row news-img">
                            <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/notice_min.png" width="100%" height="100%">
                        </div>
                        <div class="row news-list">
                            <div class="row news-item">
                                <div class="col-md-8">
                                    <span class="news-name">烟台大风预警</span>
                                    <span class="news-des">今日烟台有6-7级大风</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="news-date">2017-3-13</span>
                                </div>
                            </div>
                            <div class="row news-item">
                                <div class="col-md-8">
                                    <span class="news-name">烟台大风预警</span>
                                    <span class="news-des">今日烟台有6-7级大风</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="news-date">2017-3-13</span>
                                </div>
                            </div>
                            <div class="row news-item">
                                <div class="col-md-8">
                                    <span class="news-name">烟台大风预警</span>
                                    <span class="news-des">今日烟台有6-7级大风</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="news-date">2017-3-13</span>
                                </div>
                            </div>
                            <div class="row news-item">
                                <div class="col-md-8">
                                    <span class="news-name">烟台大风预警</span>
                                    <span class="news-des">今日烟台有6-7级大风</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="news-date">2017-3-13</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 left-news">
                    <div class="row head-text">
                        <div class="little-rectangle">
                        </div>
                        <div class="head-info">
                            <p class="head-name">医院公告</p>
                            <p class="head-sub-name">Expert Team</p>
                        </div>
                    </div>

                    <div class="news-info">
                        <div class="row news-img">
                            <img alt="logo" class="media-object" data-src="holder.js/20x20" src="/images/notice_min.png" width="100%" height="100%">
                        </div>
                        <div class="row news-list">
                            <div class="row news-item">
                                <div class="col-md-8">
                                    <span class="news-name">烟台大风预警</span>
                                    <span class="news-des">今日烟台有6-7级大风</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="news-date">2017-3-13</span>
                                </div>
                            </div>
                            <div class="row news-item">
                                <div class="col-md-8">
                                    <span class="news-name">烟台大风预警</span>
                                    <span class="news-des">今日烟台有6-7级大风</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="news-date">2017-3-13</span>
                                </div>
                            </div>
                            <div class="row news-item">
                                <div class="col-md-8">
                                    <span class="news-name">烟台大风预警</span>
                                    <span class="news-des">今日烟台有6-7级大风</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="news-date">2017-3-13</span>
                                </div>
                            </div>
                            <div class="row news-item">
                                <div class="col-md-8">
                                    <span class="news-name">烟台大风预警</span>
                                    <span class="news-des">今日烟台有6-7级大风</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="news-date">2017-3-13</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container footer">
            <div class="footer-content row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <img src="/images/qrcode.png" alt="">
                </div>
            </div>
        </div>
        <script type="text/javascript">
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
        </script>
    </body>
</html>
