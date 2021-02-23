<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>后台登录Depp2.0博客系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/font.css') }}"  >
    <link rel="stylesheet" href="{{ URL::asset('admin/css/login.css') }}" >
    <link rel="stylesheet" href="{{  URL::asset('admin/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{  URL::asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<!-- /resources/views/post/create.blade.php -->

<!-- Create Post Form -->
<body class="login-bg">
    <div class="login layui-anim layui-anim-up">
        <div class="message">Depp2.0博客系统</div>
        <div id="darkbannerwrap"></div>
        <form method="post"  action="/admin/loginAuth" class="layui-form" >
            @csrf
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <div class="layui-input-inline">
                <div class="layui-input-inline">
                    <input name="code"  style="width: 150px" lay-verify="required" placeholder="验证码"  type="text" class="layui-input">
                    <p>
                        @if (method_exists($errors,'any'))
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @if(is_object($errors))
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        @else
                                            <li>{{ $errors }}</li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        @else
                            <li>{{ $errors }}</li>
                        @endif
                    </p>
                </div>
                <div class="layui-input-inline" style="margin-left: 20px">
                    <img src="{{captcha_src()}}" style="cursor: pointer;float: right" onclick="this.src='{{captcha_src()}}'+Math.random()">
                </div>
            </div>
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>
</body>
</html>
