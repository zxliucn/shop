<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
@include('admin.public.style')
@include('admin.public.js')
<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>所属分类
                </label>
                <div class="layui-input-inline">
                    <select name="cate_pid" lay-filter="aihao">
                        @foreach($cateList as $v)
                            <option @if($cateInfo->cate_pid == $v->cate_id ) selected @endif value="{{ $v->cate_id }}">{{ $v->cate_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>分类名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" value="{{$cateInfo->cate_name}}" id="cate_name" name="cate_name" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="x-red">*</span>分类视图
                </label>
                <div class="layui-input-inline">
                    <input type="text"  value="{{$cateInfo->cate_view}}" id="cate_view" name="cate_view" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="x-red">*</span>分类排序
                </label>
                <div class="layui-input-inline">
                    <input type="text" value="{{$cateInfo->cate_order}}"  id="cate_order" name="cate_order" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button class="layui-btn" lay-filter="add" lay-submit="">修改</button></div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
            });
            //监听提交
            form.on('submit(add)',
                function(data) {
                    console.log(data);
                    $.ajax({
                        url: "/admin/cate/" + {{ $cateInfo->cate_id}},
                        type:"put",
                        data:{
                            'data':data.field,
                            '_token':'{{ csrf_token() }}'
                        },
                        success : function(res) {
                            if(res.status==1){
                                layer.alert(res.msg, {
                                        icon: 6
                                    },
                                    function() {
                                        //关闭当前frame
                                        xadmin.close();
                                        // 可以对父窗口进行刷新
                                        xadmin.father_reload();
                                    });
                            }else{
                                layer.alert(res.msg, {
                                        icon: 5
                                    },
                                    function() {
                                        //失败不操作窗口
                                    });
                            }
                        },
                        error:function(result){
                        },
                    });
                    return false;
                });

        });</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>
