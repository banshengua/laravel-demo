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
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加分类</strong></div>
  <div class="body-content">
    @if(!isset($data['id']))
  <form method="post" class="form-x" action="{{url('/admin/addHandle')}}">
      <input  type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <div class="label">
          <label>分类：</label>
        </div>
        <div class="field">
          <input type="text" id="cate" name="cate" value=""/>
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
 <form method="post" class="form-x" action="{{url('/admin/cateupdateHandle')}}">
      <input  type="hidden" name="_token" value="{{csrf_token()}}">
       <input  type="hidden" name="id" value="{{$data['id']}}">
      <div class="form-group">
        <div class="label">
          <label>分类：</label>
        </div>
        <div class="field">
          <input type="text" id="cate" name="cate" value="{{$data['cate_name']}}"/>
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