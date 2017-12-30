@extends('mobile.mobile')
@section('title','提示')
@section('content')
    <div class="main" style="border: solid 1px grey;padding:0 20px;">
        <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
            <h3>成功提示</h3>
        </div>
        <div class="main_content" style="height:650px;padding-top: 15px;">
            <div class="panel panel-primary">
                <div class="panel-heading">订单确认</div>
                <div class="panel-body">
                    @if ($type == 'order')
                        @if($result['status'] == 1)
                            <p><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></p>
                            <p>{{$result['info']}}</p>
                            <p>点击查看<a href="{{"/order/list"}}" class="btn btn-info" role="button">我的订单</a></p>
                        @elseif($result['status'] == 0)
                            <p><span class="glyphicon glyphicon-remove"></span></p>
                            <p>{{$result['info']}}</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
