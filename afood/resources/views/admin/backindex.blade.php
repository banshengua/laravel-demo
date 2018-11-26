<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>
    <link rel="stylesheet" href="{{asset('resources/assets/backcss/pintuer.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/backcss/admin.css')}}">
    <script src="{{asset('resources/assets/backjs/jquery.js')}}"></script>
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
    <div class="logo margin-big-left fadein-top">
        <h1><img src="{{asset('resources/assets/backimg/y.jpg')}}" class="radius-circle rotate-hover" height="50" alt="" />后台管理中心</h1>
    </div>
    <div class="head-l"><a class="button button-little bg-green" href="{{url('good')}}" target="_blank"><span class="icon-home"></span> 前台首页</a>  &nbsp;&nbsp;</div>
</div>
<div class="leftnav">
    <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
    <h2><span class="icon-user"></span>用户管理</h2>
    <ul style="display:block">
        <li><a href="{{url('admin/userlist')}}" target="right"><span class="icon-caret-right"></span>用户列表</a></li>
        <li><a href="{{url('admin/adduser')}}" target="right"><span class="icon-caret-right"></span>添加用户</a></li>
    </ul>
    <h2><span class="icon-pencil-square-o"></span>食品管理</h2>
    <ul>
        <li><a href="{{url('admin/foodlist')}}" target="right"><span class="icon-caret-right"></span>食品列表</a></li>
        <li><a href="{{url('admin/addfood')}}" target="right"><span class="icon-caret-right"></span>添加食品</a></li>
    </ul>
    <h2><span class="icon-pencil-square-o"></span>分类管理</h2>
    <ul>
        <li><a href="{{asset('admin/catelist')}}" target="right"><span class="icon-caret-right"></span>分类列表</a></li>
        <li><a href="{{asset('admin/add')}}" target="right"><span class="icon-caret-right"></span>添加分类</a></li>
    </ul>
    <h2><span class="icon-pencil-square-o"></span>订单管理</h2>
    <ul>
        <li><a href="{{asset('admin/orderlist')}}" target="right"><span class="icon-caret-right"></span>订单列表</a></li>
    </ul>
</div>
<script type="text/javascript">
    $(function(){
        $(".leftnav h2").click(function(){
            $(this).next().slideToggle(200);
            $(this).toggleClass("on");
        })
        $(".leftnav ul li a").click(function(){
            $("#a_leader_txt").text($(this).text());
            $(".leftnav ul li a").removeClass("on");
            $(this).addClass("on");
        })
    });
</script>
<ul class="bread">
    <li><a href="{{url('admin/index')}}}" target="right" class="icon-home"> 首页</a></li>
    <li><a href="" id="a_leader_txt">内容管理</a></li>
</ul>
<div class="admin">
    <iframe scrolling="auto" rameborder="0" src="{{url('admin/foodlist')}}" name="right" width="100%" height="100%"></iframe>
</div>
<div style="text-align:center;">
    <p>来源:<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
</div>
</body>
</html>