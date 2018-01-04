@extends('web.web')
@section('title','订单统计')
@section('content')
    <div class="main" style="border: solid 1px grey;padding:0 20px;">
        <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
            <h3>订单统计</h3>
        </div>
        <div class="main_content" style="height:650px;padding-top: 15px;">
            <p>
                <input name="date" type="date" value="{{date('Y-m-d')}}"/>
                <a href="#" class="btn btn-primary btn-search" role="button">查询</a>
            </p>
            <div class="panel panel-primary">
                <div class="panel-heading">每日订单</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>商品</th>
                            <th>数量</th>
                            <th>单位</th>
                            <th>单价</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $r)
                            <tr>
                                <th scope="row">{{ $r->goods_name }}</th>
                                <td>{{ $r->total_num }}</td>
                                <th>{{ $r->goods_unit }}</th>
                                <td>{{ $r->goods_price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
