@extends('web.web')
@section('title','文章分类管理')
@section('content')
    @if ($op == "show")
        <div class="main" style="border: solid 1px grey;padding:0 20px;">
            <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
                <h3>文章分类管理<a class="btn btn-primary pull-right" type="button" href="{{"/articlecate/edit/0"}}">添加</a></h3>
            </div>
            <div class="main_content" style="height:650px;padding-top: 15px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">分类列表</div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>分类名称</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $r)
                            <tr>
                                <th scope="row">{{ $r->id }}</th>
                                <td>{{ $r->category_name }}</td>
                                <td>
                                    <a href="{{"/articlecate/edit/$r->id"}}" class="btn btn-default btn-sm" title="修改"><i class="fa fa-edit"></i></a>
                                    <a id="btn_del" href="{{"/articlecate/del/$r->id"}}" class="btn btn-default btn-sm" title="删除"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @elseif($op == "edit")
        <div class="main">
            <style>
                .form-group{min-height: 40px;margin-bottom: 20px;}
                .control-label{text-align: right;}
            </style>
            <div class="panel panel-primary">
                <div class="panel-heading">文章分类管理</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"><span style="color: red;">*</span>文章分类名称</label>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="category_name" id="category_name" class="form-control" value="{{$result->category_name or ''}}">
                        </div>
                        <div class="col-sm-2">
                            <span style="color:red;" id="tip_category_name"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-xs-3" style="text-align: left;">
                            <button class="btn btn-primary" id="btn_submit">提交</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <script type="application/javascript">
            $("#btn_submit").click(function(){
                var category_name = $("input[name='category_name']").val();
                if(category_name == ""){
                    $("#tip_category_name").text("分类名称不能为空！");
                    return false;
                }
                $.ajax({
                    type:"POST",
                    url:"/"+"{{Request::path()}}",
                    data:{
                        category_name:category_name
                    },
                    success:function(data){
                        if(data.status == 1){
                            alert(data.info);
                            location.href = "{{url("/articlecate")}}";
                        }else{
                            alert(data.info);
                        }

                    }
                });
            });
        </script>
    @endif
@endsection
