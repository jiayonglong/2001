@extends('admin.layout.gong')
@section('title', '商品品牌列表')
@section('content')

    <center><h1>商品品牌列表<a style="float:right" href="{{url('/brand/brand')}}" type="button" class="btn btn-default">添加</a></h1></center><hr/>
<div class="table-responsive">
    <form>
        <input type="text" name="name"  placeholder="请输入品牌关键字" value="{{$query['name']??''}}">
        <input type="text" name="url"  placeholder="请输入网址关键字" value="{{$query['url']??''}}">
        <button>搜索</button>
    </form>
    <table class="table">
        <thead>
        <tr>
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
                <td>{{$v->brand_id}}</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td><img src="{{$v->brand_logo}}" width="50"></td>
                <th>{{$v->brand_desc}}</th>
                <th><a href="{{url('/brand/edit/'.$v->brand_id)}}" id="{{$v->brand_id}}" type="button" class="btn btn-danger">删除</a>
                <a href="javascript:void(0);" id="{{$v->brand_id}}" type="button" class="btn btn-danger">编辑</a></th>
            </tr>
        @endforeach

        </tbody>

    </table>
    <tr>
        <td colspan="6">
            {{$brand->links('vendor.pagination.adminshop')}}
        </td>
    </tr>
</div>
@endsection
