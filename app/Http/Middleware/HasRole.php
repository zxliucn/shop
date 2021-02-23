<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PhpParser\Node\Stmt\Foreach_;

class  HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //1.获取当前请求的路由
        $route = \Route::current()->getActionName();
        // 2.获取当前用户权限组
        $uid= session()->get('user')->admin_id;
        $roleInfo = DB::table('admin_role')->where("admin_id",$uid)->first();
        $sql = "select per_id from blog_role_per where role_id in ({$roleInfo->role_id})";
        $perInfo = DB::select($sql);
        $perUrlArray=[];
        foreach ($perInfo as $v){
            $perId = explode(",",$v->per_id);
            $perInfo = DB::table('permission')->whereIn("id",$perId)->get()->toArray();
            foreach ($perInfo as $value){
                if(!in_array($value->per_url,$perUrlArray)){
                    $perUrlArray[]=$value->per_url;
                }
            }
        }
        if(in_array($route,$perUrlArray)){
            return $next($request);
        }else{
            return redirect("admin/noauth");
        }
    }
}
