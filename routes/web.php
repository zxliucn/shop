<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function (){
    return "你好，这是首页";
});

Route::match('get','hello/{id?}/{name?}',function ($id = null,$name=null){
    return "你好，这是match控制".$id.$name;
});


/**
 * 博客登录后台统一路由配置
 */
//不需要登录验证
Route::group(['prefix'=>'admin'],function (){
    //后台登录页
    Route::get('index',  [App\Http\Controllers\Admin\LoginController::class, 'index']);

    //验证登录
    Route::post('loginAuth',[App\Http\Controllers\Admin\LoginController::class, 'loginAuth']);
    Route::get('douyin',  [App\Http\Controllers\Admin\TestController::class, 'index']);
    Route::get('noauth', [App\Http\Controllers\Admin\UserController::class, 'noauth']);
    Route::any('home',  [App\Http\Controllers\Admin\LoginController::class, 'home']);
    Route::any('testRedis',  [App\Http\Controllers\Admin\TestController::class, 'testRedis']);

    //退出登录
    Route::get('loginOut',  [App\Http\Controllers\Admin\LoginController::class, 'loginOut']);
});
//需要登录验证
Route::group(['prefix'=>'admin','middleware'=>['isLogin','hasRole']],function (){
    //后台首页
    //后台欢迎页
    Route::get('welcome', [App\Http\Controllers\Admin\LoginController::class, 'welcome']);

    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', App\Http\Controllers\Admin\RolesController::class);
    Route::resource('funs', App\Http\Controllers\Admin\FunsController::class);
    Route::resource('cate', App\Http\Controllers\Admin\CateController::class);
    Route::resource('art', App\Http\Controllers\Admin\ArticleController::class);

});

/**
 * 博客登录前台统一路由配置
 */







