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
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
<h5 style="color: red;">@if(session('err')!=null) {{session('err')}}  @endif</h5>
  @if(!isset($data))
    <form method="post" class="form-x" action="{{url('/admin/addfoodHandle')}}" enctype="multipart/form-data">
      <input  type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <div class="label">
          <label>分类：</label>
        </div>
        <div class="field">
  <select name="cate">
  @foreach($cates as $cate)
  <option value ="{{$cate['id']}}" selected>{{$cate['cate_name']}}</option>
 @endforeach
</select>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>名字</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="name" name="name" data-validate="required:请输入名字" />
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>价格</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="price" name="price" data-validate="required:请输入分类标题" />
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
          <input type="file" class="input" id="pic" name="pic"  />
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>月售份数</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="sellcount" name="sellcount" data-validate="required:请输入月售份数" />
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>剩余份数</label>
        </div>
        <div class="field">
          <input type="text" class="laydate-icon input w50" id="surplus" name="surplus"  value=""  data-validate="required:剩余份数不能为空" style="padding:10px!important; height:auto!important;border:1px solid #ddd!important;" />
          <div class="tips"></div>
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
     <form method="post" class="form-x" action="{{url('/admin/foodupdateHandle')}}" enctype="multipart/form-data">
      <input  type="hidden" name="_token" value="{{csrf_token()}}">
      <input  type="hidden" name="id" value="{{$data['id']}}">
      <div class="form-group">
        <div class="label">
          <label>分类：</label>
        </div>
        <div class="field">
  <select name="cate">
  @foreach($cates as $cate)
  <option value ="{{$cate['id']}}"  @if($cate['id']==$data['pid']) selected="selected"
  @endif   >{{$cate['cate_name']}}</option>
 @endforeach
</select>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>名字</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="name" name="name" value="{{$data['name']}}"  data-validate="required:请输入名字" />
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>价格</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="price" name="price" data-validate="required:请输入分类标题" value="{{$data['price']}}"/>
        </div>
      </div>
      <div class="form-group">
      <img src="{{asset($data['img'])}}"  alt="" width="90" height="90" />
        <div class="label">
          <label>图片：</label>
        </div>
        
        <div class="field">
          <input type="file" class="input" id="pic" name="pic"  />
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>月售份数</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" id="sellcount" name="sellcount" data-validate="required:请输入月售份数" value="{{$data['sellcount']}}"/>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>剩余份数</label>
        </div>
        <div class="field">
          <input type="text" class="laydate-icon input w50" id="surplus" name="surplus"  value="{{$data['surplus']}}" data-validate="required:剩余份数不能为空" style="padding:10px!important; height:auto!important;border:1px solid #ddd!important;" />
          <div class="tips"></div>
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