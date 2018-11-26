<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="renderer" content="webkit">
<title>添加页面</title>
  <link rel="stylesheet" href="{{asset('resources/assets/backcss/pintuer.css')}}">
  <link rel="stylesheet" href="{{asset('resources/assets/backcss/admin.css')}}">
  <script src="{{asset('resources/assets/backjs/jquery.js')}}"></script>
  <script src="{{asset('resources/assets/backjs/pintuer.js')}}"></script>
  <script  src="{{asset('resources/assets/backjs/addbill.js')}}" ></script>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加用户</strong></div>
  <div class="body-content">
  <h5 style="color: red;">@if(session('err')!=null) {{session('err')}}  @endif</h5>
  @if(!isset($data))
    <form method="post" class="form-x" action="{{url('/admin/adduserHandle')}}">
      <input  type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <div class="label">
          <label>号码：</label>
        </div>
        <div class="field">
          <input type="text" id="phone" name="phone" value=""/>
        </div>
      </div>
      
      <div class="form-group">
        <div class="label">
          <label>密码：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="tname" name="pwd" data-validate="required:请输入密码" />
        </div>
      </div>
      
  

      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
    @else
 <form method="post" class="form-x" action="{{url('/admin/userupdateHandle')}}">
      <input  type="hidden" name="_token" value="{{csrf_token()}}">
        <input  type="hidden" name="id" value="{{$data['id']}}">
      <div class="form-group">
        <div class="label">
          <label>号码：</label>
        </div>
        <div class="field">
          <input type="text" id="phone" name="phone" value="{{$data['phone']}}"/>
        </div>
      </div>
      
      <div class="form-group">
        <div class="label">
          <label>密码：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="tname" name="pwd" data-validate="required:请输入密码"  value="{{$data['pwd']}}" />
        </div>
      </div>
      
  

      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>

    @endif
  </div>
</div>
</body></html>