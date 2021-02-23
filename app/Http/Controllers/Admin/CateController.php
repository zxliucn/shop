<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CateController extends Controller
{
    /**
     * 分类列表展示页
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catesList = DB::table("category")
            ->orderBy('cate_id','ASC')
            ->where(function ($queue) use($request){
                $cateName=$request->input('cate_name');
                if(!empty($username)){
                    $queue->where('cate_name','like','%'.$cateName.'%');
                }
            })->paginate($request->input('page_num')??7);

        $catesList=$this->tree($catesList);
        return  view("admin.cate.cate-list",compact('catesList','request'));
    }

    /**
     * Notes: 树形排列分类
     * User: Depp
     * Date: 2020/10/20
     * Time: 16:11
     * @param $list
     * @return array
     */
    public function tree($list){
        $newList=[];
        foreach ($list as $v){
            if($v->cate_pid==0){
                $newList[]=$v;
                foreach ($list as $value){
                    if($value->cate_pid==$v->cate_id){
                        $value->cate_name="|---".$value->cate_name;
                        $newList[]=$value;
                    }
                }
            }
        }
        return (object)$newList;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateList = DB::table('category')->where('cate_pid',0)->get();
        return view("admin.cate.cate-add",compact("cateList"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inData=$request->all()['data'];
        $res=DB::table("category")->insert($inData);
        $data=['status'=>1,'msg'=>'添加成功'];
        if(!$res){
            $data=['status'=>0,'msg'=>'添加失败，请检查原因！！'];
        }
        return $data;
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
        $cateInfo=DB::table("category")->where('cate_id',$id)->first();
        $cateList = DB::table('category')->where('cate_pid',0)->get();
        return view("admin.cate.cate-edit",compact("cateInfo","cateList"));
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
        $upData=$request->all()['data'];
        $res=DB::table("category")->where('cate_id',$id)->update($upData);
        $data=['status'=>1,'msg'=>'更改成功'];
        if(!$res){
            $data=['status'=>0,'msg'=>'更改失败，请检查原因！！'];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=DB::table("category")->where('cate_id',$id)->delete();
        $data=['status'=>1,'msg'=>'删除成功'];
        if(!$res){
            $data=['status'=>0,'msg'=>'删除失败，请检查原因！！'];
        }
        return $data;
    }
}
