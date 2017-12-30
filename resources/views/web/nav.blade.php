@extends('web.web')
@section('title','幻灯片管理')
@section('content')
    @if ($op == "show")
        <div class="main" style="border: solid 1px grey;padding:0 20px;">
        <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
            <h3>幻灯片管理<a class="btn btn-primary pull-right" type="button" href="{{"/nav/edit/0"}}">添加</a></h3>
        </div>
        <div class="main_content" style="height:650px;padding-top: 15px;">
            <div class="panel panel-primary">
                <div class="panel-heading">幻灯片列表</div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>显示顺序</th>
                        <th>标题</th>
                        <th>链接</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($result as $r)
                        <tr>
                            <th scope="row">{{ $r->id }}</th>
                            <td>{{ $r->displayorder }}</td>
                            <td>{{ $r->advname}}</td>
                            <td>{{ $r->link }}</td>
                            <td>
                                @if ($r->enabled == 1)
                                    <span class="label label-primary">显示</span>
                                @else ($r->enabled == 0)
                                    <span class="label label-danger">隐藏</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{"/nav/edit/$r->id"}}" class="btn btn-default btn-sm" title="修改"><i class="fa fa-edit"></i></a>
                                <a id="btn_del" href="{{"/nav/del/$r->id"}}" class="btn btn-default btn-sm" title="删除"><i class="fa fa-times"></i></a>
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
                <div class="panel-heading">幻灯片管理</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label">排序</label>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="displayorder" id="displayorder" class="form-control" value="{{$result->displayorder or ''}}">
                            <span class="help-block">数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"><span style="color: red;">*</span>幻灯片标题</label>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="advname" id="advname" class="form-control" value="{{$result->advname or ''}}">
                        </div>
                        <div class="col-sm-2">
                            <span style="color:red;" id="tip_advname"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"><span style="color: red;">*</span>幻灯片图片</label>
                        <div class="col-sm-7 col-xs-7">
                            <div class="input-group">
                                <input type="text" name="thumb" id="thumb" class="form-control" value="{{$result->thumb or ''}}">
                                <span class="input-group-btn"><button class="btn btn-primary" onclick="uploadImg();">上传图片</button></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label">幻灯片链接</label>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="link" id="link" class="form-control" value="{{$result->link or ''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label">是否显示</label>
                        <div class="col-sm-7 col-xs-7">
                            <label class="radio-inline">
                                <input type="radio" name="enabled" value="1" @if($result && $result->enabled == 1) checked="checked" @endif> 是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="enabled" value="0" @if($result && $result->enabled == 0) checked="checked" @endif> 否
                            </label>
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
            function uploadImg(){
                alert("hhh");
            }
            $("#btn_submit").click(function(){
                var advname = $("input[name='advname']").val();
                if(advname == ""){
                    $("#tip_advname").text("标题不能为空！");
                    return false;
                }
                $.ajax({
                    type:"POST",
                    url:"/"+"{{Request::path()}}",
                    data:{
                        advname:advname,
                        link:$("input[name='link']").val(),
                        thumb:$("input[name='thumb']").val(),
                        enabled:$("input:radio[name='enabled']:checked").val(),
                        displayorder:$("input[name='displayorder']").val()
                    },
                    success:function(data){
                        if(data.status == 1){
                            alert(data.info);
                            location.href = "{{url("/nav")}}";
                        }else{
                            alert(data.info);
                        }

                    }
                });
            });
        </script>
    @endif
@endsection