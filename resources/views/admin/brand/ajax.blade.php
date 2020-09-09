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
        {{$brand->appends($query)->links('vendor.pagination.adminshop')}}
        <button class="mordel">批量删除</button>
    </td>
</tr>

