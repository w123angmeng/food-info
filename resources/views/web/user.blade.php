@extends('web.web')
@section('title','用户管理')
@section('content')
    <div class="main" style="border: solid 1px grey;padding:0 20px;">
        <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
            <h3>用户管理</h3>
        </div>
        <div class="main_content" style="height:650px;padding-top: 15px;">
            <div class="panel panel-primary">
                <div class="panel-heading">用户列表</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>用户Id</th>
                            <th>用户名</th>
                            <th>角色</th>
                            <th>姓名</th>
                            <th>手机号</th>
                            <th>邮箱</th>
                            <th>上次登录时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $r)
                            <tr>
                                <th scope="row">{{ $r->uid }}</th>
                                <th>{{ $r->username }}</th>
                                <td>{{ $r->role }}</td>
                                <td>{{ $r->realname }}</td>
                                <td>{{ $r->phone }}</td>
                                <td>{{ $r->email }}</td>
                                <td>{{ $r->lastvisit }}</td>
                                <td>
                                    <a id="btn_del" href="{{"/goods/del/$r->uid"}}" class="btn btn-default btn-sm" title="删除"><i class="fa fa-times"></i></a>
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
