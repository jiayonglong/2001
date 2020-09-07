@extends('admin.layout.gong')
@section('title', '商品添加')
@section('content')
<center><h1>商品品牌编辑</h1></center><hr/>
<form action="{{url('/brand/update/'.$brand->brand_id)}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="brand_name"
                   value="{{$brand->brand_name}}"
                   placeholder="请输入品牌名称">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="brand_url"  value="{{$brand->brand_url}}"
                   placeholder="请输入品牌网址">
        </div>
    </div>
    <div class="form-group">

        <label for="firstname" class="col-sm-2 control-label">品牌LOGO</label>

        <div class="col-sm-4">
            <div class="layui-upload-drag" id="test10">
                <input type="hidden" name="brand_logo">
                <i class="layui-icon"></i>
                <p>点击上传，或将文件拖拽到此处</p>
                @if($brand->brand_logo)<img src="{{env('IMG_URL')}}{{$brand->brand_logo}}" width="40"height="40">@endif
                <div class="layui-hide" id="uploadDemoView">
                    <hr>
                    <img src="" alt="上传成功后渲染" style="max-width: 196px">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="brand_desc"
                      placeholder="请输入品牌描述"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>
<script src="/layui/layui.js"></script>
<script src="/layui/layui.all.js"></script>
<script>
    layui.use('element', function() {
        var element = layui.element;
    });
    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //拖拽上传
        upload.render({
            elem: '#test10'
            ,url: 'http://www.blog.com/brand/uploads' //改成您自己的上传接口
            ,done: function(res){
                layer.msg(res.msg);
                layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.data);
                console.log(res)
                layui.$('input[name="brand_logo"]').attr('value',res.data);
            }
        });
    });




</script>
@endsection
