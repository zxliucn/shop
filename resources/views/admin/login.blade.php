<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin 后台登录</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap.min.css') }} " />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-responsive.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/matrix-login.css') }}" />
    <link href="{{  URL::asset('admin/font-awesome/css/font-awesome.css') }}"  rel="stylesheet" />
</head>
<body>

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

<div id="loginbox">
    <form id="loginform" method="post" class="form-vertical" action="/admin/loginAuth">
        @csrf
        <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"></i></span><input type="text" name="username" value="{{ old('username') }}"  placeholder="用户名" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="密码" value="{{ old('password') }}"  />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-star"></i></span><input type="text" name="code"  placeholder="验证码" />
                </div>
            </div>
        </div>
        <div class="controls" style=" text-align: center;">
            <img src="{{captcha_src()}}" style="cursor: pointer;" onclick="this.src='{{captcha_src()}}'+Math.random()">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success pull-right">登录</button>
        </div>
    </form>
</div>
</body>

<script src="{{ URL::asset('admin/js/jquery.min.js') }}"  ></script>
<script>
    jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();</script>
<script src="{{  URL::asset('admin/js/matrix.login.js') }}"  ></script>
</html>
