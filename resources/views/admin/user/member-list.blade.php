@include('admin.public.header')
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
@include('admin.public.sidebar')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
            <h5>Notifications</h5>
        </div>
        <div class="widget-content">
            <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">Success!</h4>
                Tou're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                首页数据展示
            </div>
            <form class="layui-form layui-col-space5" method="get" action="{{url("admin/user")}}">
                <div class="layui-input-inline">
                    <select name="page_num" lay-filter="aihao">
                        <option value="4" @if($request->input("page_num")==4) selected @endif>4</option>
                        <option value="10" @if($request->input("page_num")==10) selected @endif>10</option>
                    </select>
                </div>
                <div class="layui-inline layui-show-xs-block">
                    <input type="text" name="username"  value="{{ $request->input('username') }}" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-inline layui-show-xs-block">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                </div>
            </form>
        </div>
    </div>
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
            <h1>Tables</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Data table</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>邮箱</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userList as $v)
                                    <tr>
                                        <td>{{$v->admin_id}}</td>
                                        <td>{{$v->admin_name}}</td>
                                        <td>{{$v->admin_email}}</td>
                                        <td class="td-manage">
                                            <a title="编辑"  onclick="xadmin.open('编辑','{{url('admin/user/'.$v->admin_id.'/edit')}}',600,400)" href="javascript:;">
                                                <i class="layui-icon">&#xe642;</i>
                                            </a>
                                            <a title="删除" onclick="member_del(this,'{{$v->admin_id}}')" href="javascript:;">
                                                <i class="layui-icon">&#xe640;</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var  form = layui.form;


        // 监听全选
        form.on('checkbox(checkall)', function(data){

            if(data.elem.checked){
                $('tbody input').prop('chec ked',true);
            }else{
                $('tbody input').prop('checked',false);
            }
            form.render('checkbox');
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

            }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 6,time:1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                url:  "/admin/user/" + id,
                type:"DELETE",
                data:{
                    '_token':'{{ csrf_token() }}'
                },
                success:function (result) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }
            });
        });
    }


    function delAll (argument) {
        var ids = [];

        // 获取选中的id
        $('tbody input').each(function(index, el) {
            if($(this).prop('checked')){
                ids.push($(this).val())
            }
        });

        layer.confirm('确认要删除吗？'+ids.toString(),function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
@include('admin.public.fooder')
