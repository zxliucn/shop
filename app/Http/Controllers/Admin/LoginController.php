<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Notes: 后台登录首页
     * User: Depp
     * Date: 2020/9/21
     * Time: 16:43
     */
    public function index()
    {
        return view("admin.login");
    }

    /**
     * Notes:用户登录方法
     * User: Depp
     * Date: 2020/9/21
     * Time: 16:58
     */
    public function loginAuth(Request $request)
    {
        $input = $request->except('_token');
        $rules = [
            'username' => 'required|between:4,18',
            'password' => 'required|between:6,18',
            'code' => 'required|captcha',
        ];

        $msg=[
            'username.required'=>"用户名不能为空",
            'username.between' =>"用户名长度必须为4~18位之间",
            'password.required'=>"密码不能为空",
            'password.between' =>"密码长度必须为4~18位之间",
            'code.required'=>"验证码不能为空",
            'code.captcha'=>"验证码不正确，请重新输入",
        ];

        $validator=Validator::make($input,$rules,$msg);

        if($validator->fails()){
            return redirect('admin/index')
                ->withErrors($validator)
                ->withInput();
        }

        $userInfo= Admin::query()->where([
            'admin_name'=> $input['username']
        ])->first();



        if(!$userInfo){
            return redirect('admin/index')
                ->with('errors',"该用户不存在，请重新输入");
        }
        if(!Hash::check($input['password'],$userInfo['admin_pass']))
        {
            return redirect('admin/index')
                ->with('errors',"用户密码不正确，请重新输入");
        }
        /**
         * 处理用户信息 session存储用户信息
         */
        session()->put('user',$userInfo);
        return redirect('admin/home');
    }

    public function  home(){
        return view("admin.home");
    }

    /**
     * Notes:后台首页欢迎页
     * User: Depp
     * Date: 2020/9/22
     * Time: 16:51
     */
    public function welcome(){
        return view("admin.welcome");
    }

    /**
     * Notes:后台登出页面
     * User: Depp
     * Date: 2020/9/22
     * Time: 18:22
     */
    public function loginOut(){
        session()->flush();
        return redirect('admin/index');
    }

}
