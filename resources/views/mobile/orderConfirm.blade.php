@extends('mobile.mobile')
@section('title','确认订单')
@section('content')
    <div class="main" style="border: solid 1px grey;padding:0 20px;">
        <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
            <h3>订单确认<a class="btn btn-primary pull-right" type="button" href="{{"/order/create"}}">提交订单</a></h3>
        </div>
        <div class="main_content" style="height:650px;padding-top: 15px;">
            <div class="panel panel-primary">
                <div class="panel-heading">订单确认</div>
                <div class="panel-body">
                    <ul class="media-list">
                        @foreach ($result as $r)
                            <li class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" data-src="holder.js/80%x80" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMzE5IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDMxOSAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVhM2ZkOTk0MjYgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxNnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWEzZmQ5OTQyNiI+PHJlY3Qgd2lkdGg9IjMxOSIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMTcuOTg0Mzc1IiB5PSIxMDcuMiI+MzE5eDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height:100px;width:100px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$r->name}}</h4>
                                    <p>单价：{{$r->price}}&nbsp;&nbsp;数量：{{$r->num}}{{$r->unit}}</p>
                                </div>
                            </li>
                        @endforeach
                        <li class="media">
                            <div class="media-left">

                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">下单人：{{session('user')["username"]}}</h4>
                                <h4 class="media-heading">下单时间：{{date("Y-m-d H:i:s")}}</h4>
                                <h4 class="media-heading">总数量：{{$total_num}}件&nbsp;&nbsp; 总价：{{$total_price}}元</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection