@extends('admin.layout.gong')
@section('title', '商品品牌列表')
@section('content')

    <center><h1>商品品牌列表<a style="float:right" href="{{url('/brand/brand')}}" type="button" class="btn btn-default">添加</a></h1></center><hr/>
<div class="table-responsive">
    <form>
        <input type="text" name="brand_name"  placeholder="请输入品牌关键字" value="{{$query['brand_name']??''}}">
        <input type="text" name="brand_url"  placeholder="请输入网址关键字" value="{{$query['brand_url']??''}}">
        <button>搜索</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th><input type="checkbox" name="checkboxone" id="checkboxone" class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary">
            </th>
            <th>品牌ID</th>
            <th>品牌名称</th>
            <th>品牌网址</th>
            <th>品牌LOGO</th>
            <th>品牌描述</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($brand as $v)
            <tr>
                <td><input type="checkbox" name="checkboxtwo" class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary" value="{{$v->brand_id}}">
                    </td>
                <td>{{$v->brand_id}}</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td><img src="{{$v->brand_logo}}" width="50"></td>
                <th>{{$v->brand_desc}}</th>
                <th><a href="{{url('/brand/edit/'.$v->brand_id)}}" id="{{$v->brand_id}}" type="button" class="btn btn-dange">编辑</a>
                <a href="javascript:void(0);" id="{{$v->brand_id}}" type="button" class="btn btn-danger">删除</a>
                </th>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">
                {{$brand->appends(["query"=>$query])->links('vendor.pagination.adminshop')}}
                <button class="mordel">批量删除</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
    <script>
        //全选
        $(document).on('click','.layui-form-checkbox:eq(0)',function (){
            var checkedval = $('input[name="checkboxone"]').prop('checked');
            if(checkedval){
                $('input[name="checkboxtwo"]').prop('checked',true);
            }else{
                $('input[name="checkboxtwo"]').prop('checked',false);
            }
        });
        $('.mordel').click(function (){
            // alert(111);
            var ids = new Array();
            $('input[name="checkboxtwo"]:checked').each(function (i,k){
                ids.push($(this).val());
            })
            $.get('/brand/destroy',{ids,ids},function(rest){
                if(rest.error_no == '1'){
                    location.reload();
                }
            },'json');
        })
        //ajax删除
        $('.btn-danger').click(function(){
            var id = $(this).attr('id');
            var isdel = confirm('确定删除吗?');
            if(isdel == true){
                $.get('/brand/destroy/'+id,function(rest){
                    if(rest.error_no == '1'){
                        location.reload();
                    }
                },'json');
            }
        });
        //分页
        $(document).on('click','#layui-laypage-1 a',function(){
            // alert(111);
            var url = $(this).attr('href');
            $.get(url,function(result){
                $('tbody').html(result);
            });
            return false;
        });

    </script>
@endsection
