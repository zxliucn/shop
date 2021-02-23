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
            <form action="" method="post" class="layui-form layui-form-pane">
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="role_name"  value="{{ $roleInfo->role_name }}" name="role_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            @foreach($perType as $v)
                            <tr>
                                <td>
                                    <input type="checkbox" lay-skin="primary" lay-filter="father" title="{{ $v->per_type }}">
                                </td>
                                <td>
                                    <div class="layui-input-block">
                                        @foreach($perDetail as $value )
                                            @if($value->per_type == $v->per_type)
                                                <input  class="per_id" @if(in_array($value->id,$idsArray)) checked @endif lay-skin="primary" type="checkbox" title="{{$value->per_name}}" value="{{$value->id}}">
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容"  value="{{ $roleInfo->role_des }}" id="role_des" name="role_des" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">修改</button>
              </div>
            </form>
        </div>
    </div>
    <script>
        $().ready(function (){
            $("#role_des").val('{{ $roleInfo->role_des }}');
        });
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

          //自定义验证规则
          form.verify({
          });
            form.on('submit(add)',
                function(data) {
                    console.log(data);
                    var ids = [];
                    $('.per_id').each(function(index, el) {
                        if($(this).prop('checked')){
                            ids.push($(this).val())
                        }
                    });

                    $.ajax({
                            url: "/admin/roles/" + {{ $roleInfo->id}},
                            type:"put",
                            data:{
                                'data':data.field,
                                '_token':'{{ csrf_token() }}',
                                'per_id':ids.toString()
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
                                            icon: 6
                                        },
                                        function() {
                                        });
                                }
                            }
                    });
                    //发异步，把数据提交给php
                    return false;
                });


        form.on('checkbox(father)', function(data){

            if(data.elem.checked){
                $(data.elem).parent().siblings('td').find('input').prop("checked", true);
                form.render();
            }else{
               $(data.elem).parent().siblings('td').find('input').prop("checked", false);
                form.render();
            }
        });


        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>
