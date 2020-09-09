<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
use Validator;
use App\Http\Requests\StoreBlogPost;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_name = request()->brand_name;
//        dd($brand_name);
        $where=[];
        if ($brand_name){
            $where[] = ['brand_name','like','%brand_name%'];
        }
        $brand_url = request()->brand_url;
//        dd($brand_url);
        $where=[];
        if ($brand_url){
            $where[] = ['brand_url','like','%brand_url%'];
        }
        $bran = new Brand();
        $brand = $bran::where($where)->orderby('brand_id','desc')->paginate(3);
        $query = request()->all();
        if(request()->ajax()){
            return view('admin.brand.ajax',['brand'=>$brand,'query'=>$query]);
        }
        return view('admin.brand.index',['brand'=>$brand,'query'=>$query]);
    }
    public function uploads(request $request){


        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $photo = $request->file;
            $store_result = $photo->store('upload');
            return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('IMG_URL').$store_result]);
        }
        return json_encode(['code'=>2,'msg'=>'上传失败']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.brand');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        $post = $request->except('_token');
        $validator = Validator::make($post,[
            'brand_name'=>'required|unique:brand|max:20',
            'brand_url'=>'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_name.max'=>'品牌名称最大长度不超20',
            'brand_url.required'=>'品牌网址必填',
        ]);

        $res = Brand::insert($post);
        if($res){
            return redirect('/brand/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::where('brand_id',$id)->first();
        return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //接受所有值
        $post = $request->except('_token');
        // dd($post);
        $res = Brand::where('brand_id',$id)->update($post);
        if($res!==false){
            return redirect('/brand/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids=0)
    {
        $ids = request()->all();
//        dd($ids);
        if(!$ids){
            return;
        }
        foreach ($ids as $v=>$k){
//            dd($k);
            $res = Brand::destroy($k);
        }

        if($res){
            if(request()->ajax()){
                return json_encode(['error_no'=>'1','error_msg'=>'删除成功']);
            }
            return redirect('brand/index');
        }

    }
}
