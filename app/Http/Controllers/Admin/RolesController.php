<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * 角色管理首页
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rolesList = DB::table("role")
            ->orderBy('id','desc')
            ->where(function ($queue) use($request){
                $username=$request->input('role_name');
                if(!empty($username)){
                    $queue->where('role_name','like','%'.$username.'%');
                }
            })
            ->paginate($request->input('page_num')??5);
        return  view("admin.roles.role-list",compact('rolesList','request'));
    }

    /**
     * 添加角色
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取权限分类
        $perType=DB::table('permission')->groupBy('per_type')->get('per_type');
        //获取权限详情
        $perDetail=DB::table('permission')->get();
        return view("admin.roles.role-add",compact('perDetail','perType'));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $roleData = $request->all()['data'];
        $inRes = DB::table('role')->insertGetId($roleData);
        $data=['status'=>1,'msg'=>'添加成功'];
        if($inRes){
            $inData =[
                'role_id'=>$inRes,
                'per_id'=>$request->all()['per_id'],
            ];
            $res = DB::table('role_per')->insert($inData);
            if(!$res){
                $data=['status'=>0,'msg'=>'添加失败，请检查原因！！'];
            }
        }
        return  $data;
    }

    /**
     * 查看角色详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 修改角色信息
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取角色信息
        $roleInfo=DB::table('role')->where('id',$id)->first();
        //获取权限信息
        $perId = DB::table('role_per')->where('role_id',$id)->get('per_id');
        $idsArray= explode(',',$perId[0]->per_id);

        //获取权限分类
        $perType=DB::table('permission')->groupBy('per_type')->get('per_type');
        //获取权限详情
        $perDetail=DB::table('permission')->get();

        return view("admin.roles.role-edit",compact('roleInfo','idsArray','perDetail','perType'));

    }

    /**
     * 更新角色信息
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roleData = $request->all()['data'];
        $inRes = DB::table('role')->where('id',$id)->update($roleData);
        $data=['status'=>1,'msg'=>'修改成功'];
        $upData =[
            'role_id'=>$id,
            'per_id'=>$request->all()['per_id'],
        ];
        $res = DB::table('role_per')->where('role_id',$id)->update($upData);
        if(!$res){
            $data=['status'=>0,'msg'=>'修改失败，请检查原因！！'];
        }
        return  $data;
    }

    /**
     * 删除角色信息
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
