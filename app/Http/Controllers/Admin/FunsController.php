<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FunsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * 权限管理
         */
        $funsList = DB::table("permission")
            ->orderBy('id','desc')
            ->where(function ($queue) use($request){
                $perName=$request->input('per_name');
                $perType=$request->input('per_type');
                if(!empty($perName)){
                    $queue->where('per_name','like','%'.$perName.'%');
                }
                if(!empty($perType)){
                    $queue->where('per_type','like','%'.$perType.'%');
                }
            })
            ->paginate($request->input('page_num')??7);

        return  view("admin.funs.funs-list",compact('funsList','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.funs.funs-add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info=$request->all()['data'];

        $inData=[
            'per_name' =>  $info['funs_name'],
            'per_url'  =>  $info['funs_url'],
            'per_type' =>  $info['funs_type'],
        ];

        $res=DB::table('permission')->insert($inData);
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
        $funsInfo=DB::table("permission")->where('id',$id)->first();
        return view("admin.funs.funs-edit",compact('funsInfo'));
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
        $inData=[
            'per_name' =>  $upData['funs_name'],
            'per_url'  =>  $upData['funs_url'],
            'per_type' =>  $upData['funs_type'],
        ];
        $res=DB::table("permission")->where('id',$id)->update($inData);
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
        $res=DB::table("permission")->where('id',$id)->delete();
        $data=['status'=>1,'msg'=>'删除成功'];
        if(!$res){
            $data=['status'=>0,'msg'=>'删除失败，请检查原因！！'];
        }
        return $data;
    }
}
