@extends('web.web')
@section('title','文章管理')
@section('content')
    @if ($op == "show")
        <div class="main" style="border: solid 1px grey;padding:0 20px;">
            <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
                <h3>文章管理<a class="btn btn-primary pull-right" type="button" href="{{"/article/edit/0"}}">添加</a></h3>
            </div>
            <div class="main_content" style="height:650px;padding-top: 15px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">文章列表</div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>作者</th>
                            <th>浏览量</th>
                            <th>添加时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $r)
                            <tr>
                                <th scope="row">{{ $r->id }}</th>
                                <td>{{ $r->article_title }}</td>
                                <th>{{ $r->article_author }}</th>
                                <td>{{ $r->article_readnum }}</td>
                                <td>{{ $r->article_date }}</td>
                                <td>
                                    @if ($r->article_state == 1)
                                        <span class="label label-primary">显示</span>
                                    @else ($r->article_state == 0)
                                        <span class="label label-danger">隐藏</span>
                                @endif
                                <td>
                                    <a href="{{"/article/edit/$r->id"}}" class="btn btn-default btn-sm" title="修改"><i class="fa fa-edit"></i></a>
                                    <a id="btn_del" href="{{"/article/del/$r->id"}}" class="btn btn-default btn-sm" title="删除"><i class="fa fa-times"></i></a>
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
                <div class="panel-heading">文章管理</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"><span style="color: red;">*</span>文章标题</label>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="title" id="title" class="form-control" value="{{$result->article_title or ''}}">
                        </div>
                        <div class="col-sm-2">
                            <span style="color:red;" id="tip_title"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"><span style="color: red;">*</span>文章标题</label>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="category" id="category" class="form-control" value="{{$special_categorys[0]->category_name}}">
                        </div>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="category" id="category" class="form-control" value="{{$special_categorys[0]->category_name}}">
                            <select name="category" id="">
                                @foreach($cates as $c)
                                    <option value="$c->id">$c->category_name</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <span style="color:red;" id="tip_title"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"><span style="color: red;">*</span>索引图</label>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="thumb" id="thumb" class="form-control" value="{{$result->article_thumb or ''}}">
                        </div>
                        <div class="col-sm-2">
                            <span style="color:red;" id="tip_thumb"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"><span style="color: red;">*</span>文章内容</label>
                        <div class="col-sm-7 col-xs-7">
                            <input type="text" name="content" id="content" class="form-control" value="{{$result->article_content or ''}}">
                        </div>
                        <div class="col-sm-2">
                            <span style="color:red;" id="tip_content"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label">是否发布</label>
                        <div class="col-sm-7 col-xs-7">
                            <label class="radio-inline">
                                <input type="radio" name="state" value="1" @if($result && $result->article_state == 1) checked="checked" @endif> 是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="state" value="0" @if($result && $result->article_state == 0) checked="checked" @endif> 否
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
            $("#btn_submit").click(function(){
                var title = $("input[name='title']").val();
                var thumb = $("input[name='thumb']").val();
                var content = $("input[name='content']").val();
                if(title == ""){
                    $("#tip_title").text("文章标题不能为空！");
                    return false;
                }
                if(thumb == ""){
                    $("#tip_thumb").text("索引图片不能为空！");
                    return false;
                }
                if(content == ""){
                    $("#tip_content").text("文章内容不能为空！");
                    return false;
                }
                $.ajax({
                    type:"POST",
                    url:"/"+"{{Request::path()}}",
                    data:{
                        title:title,
                        thumb:thumb,
                        content:content,
                        state:$("input:radio[name='state']:checked").val()
                    },
                    success:function(data){
                        if(data.status == 1){
                            alert(data.info);
                            location.href = "{{url("/article")}}";
                        }else{
                            alert(data.info);
                        }

                    }
                });
            });
        </script>
    @endif
@endsection
