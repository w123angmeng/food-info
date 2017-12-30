@extends('mobile.mobile')
@section('title','商品列表')
@section('content')
    <div class="main" style="border: solid 1px grey;padding:0 20px;">
        <div class="header_text" style="height:40px;line-height:40px;border-bottom:solid 1px grey;">
            <h3>商品列表
                <a href="{{"/order/confirm"}}" class="btn btn-primary pull-right" role="button">确认提交</a>
                                <span id="total-price" class="pull-right" style="@if($total_num <= 0)display:none;@endif color: red;font-size: 16px;">
                                    共
                                    <span id="total_num">{{$total_num}}</span>
                                    件
                                    &nbsp;&nbsp;
                                    共
                                    <span id="total_price">{{$total_price}}</span>
                                    元
                                </span>
            </h3>
        </div>
        <div class="main_content" style="height:auto;padding-top: 15px;">

            <div class="row">
                @foreach ($result as $r)
                    <div class="col-sm-6 col-md-3" style="padding-left:0;">
                        <div class="thumbnail" style="height:auto;">
                            <input name="id" type="hidden" value="{{$r->t_id}}">
                            <img alt="100%x180" data-src="holder.js/100%x180" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMzE5IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDMxOSAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVhM2ZkOTk0MjYgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxNnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWEzZmQ5OTQyNiI+PHJlY3Qgd2lkdGg9IjMxOSIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMTcuOTg0Mzc1IiB5PSIxMDcuMiI+MzE5eDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
                            <div class="caption">
                                <h5>{{$r->name}}</h5>
                                <p><span>价格：{{$r->price}}</span><span>  已售：{{$r->sell_num}}</span></p>
                                <p><a href="#" class="btn btn-primary btn_Add" role="button">加入购物车</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $(".btn_Add").click(function(e){
            var id = $(e.target).closest(".thumbnail").find("input[name='id']").val();
            var num = 1;
            $.ajax({
                type:"POST",
                url:"{{ url('/cart/add') }}",
                data:{
                    id:id,
                    num:num
                },
                success:function(data){
                    if(data.status == 1){
                        alert(data.info);
                        //TODO 添加成功需要更新前端数量
                        $("#total-price").css("display","block");
                        $("#total_num").text(data.total_num);
                        $("#total_price").text(data.total_price);
                    }else{
                        alert(data.info);
                    }

                }
            });
        });
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
@endsection
