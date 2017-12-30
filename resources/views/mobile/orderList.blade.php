@extends('mobile.mobile')
@section('title','订单列表')
@section('content')
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
@endsection
