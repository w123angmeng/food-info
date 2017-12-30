@extends('web.web')
@section('title','商品管理')
@section('content')
    <div class="main" style="border: solid 1px grey;padding:0 20px;">
        <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
            <h3>商品管理</h3>
        </div>
        <div class="main_content" style="height:650px;padding-top: 15px;">
            <p>
                <input name="date" type="date" value="{{date('Y-m-d')}}"/>
                <a href="#" class="btn btn-primary btn-search" role="button">查询</a>
            </p>
            <div class="panel panel-primary">
                <div class="panel-heading">商品列表</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>商品Id</th>
                            <th>商品Tid</th>
                            <th>名称</th>
                            <th>图片</th>
                            <th>单位</th>
                            <th>价格</th>
                            <th>上架时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $r)
                            <tr>
                                <th scope="row">{{ $r->id }}</th>
                                <th>{{ $r->t_id }}</th>
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->image }}</td>
                                <td>{{ $r->unit }}</td>
                                <td>{{ $r->price }}</td>
                                <td>{{ $r->oper_time }}</td>
                                <td>
                                    <a id="btn_del" href="{{"/goods/del/$r->id"}}" class="btn btn-default btn-sm" title="删除"><i class="fa fa-times"></i></a>
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
        $("#btn-search").click(function(){
            var date_time = $("input[name='date']").val();
            var date = new Date(Date.parse(date_time.replace(/-/g, "/"))).format("yyyy-MM-dd");
            $.ajax({
                type:"GET",
                url:"{{url("/web/goods/")}}"+date,
                success:function(data){
                    if(data.status == 1){
                        location.href = "{{url("/web/goods")}}";
                    }else{
                    }

                }
            });
        });
    </script>
@endsection
