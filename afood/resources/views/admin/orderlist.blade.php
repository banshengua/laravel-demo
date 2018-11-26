<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> 订单页</title>
    <link rel="stylesheet" href="{{asset('resources/assets/backcss/pintuer.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/backcss/admin.css')}}">
    <script src="{{asset('resources/assets/backjs/jquery.js')}}"></script>
    <script src="{{asset('resources/assets/backjs/pintuer.js')}}"></script>
</head>
<body>
<form method="post" action="{{url('/admin/orderlist/keyword')}}" id="listform" name="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 订单列表</strong></div>
        <div class="padding border-bottom">
            <ul class="search" style="padding-left:10px;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" placeholder="请输入用户关键字" name="keyword" class="input" style="width:250px; line-height:17px;display:inline-block" />
                    <a href="javascript:void(document.listform.submit())" class="button border-main icon-search" > 搜索</a></li>
            </ul>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th  style="text-align:left; padding-left:20px;">id</th>
                <th >列表</th>
                 <th >价格</th>
                 <th >时间</th>
                <th >用户</th>
                <th >操作</th>
            </tr>
            @if(isset($datas))

                @foreach($datas as $data)
                <tr class="notfind">
                    <td>{{$data['rec_id']}}</td>
                    <td>{{$data['rec_list']}}</td>
                    <td>{{$data['rec_price']}}</td>
                      <td>{{$data['rec_time']}}</td>
                      <td>{{$data['rec_phone']}}</td>
                    <td><div class="button-group"><a class="button border-red" id="del" href="javascript:void(0)" onclick=" return del('{{$data['rec_id']}}')"><span class="icon-trash-o"></span> 删除</a> </div></td>

                </tr>

                @endforeach
                <tr>
                    <td colspan="15">  <div class="pagelist" id="Pagelist">
                            {{ $datas->appends(['Keyword' => isset($Keyword)?$Keyword:null])->links() }}</div>
                </td></tr>
            @endif
        </table>
    </div>
</form>
<script type="text/javascript">
window.onload=function(){
var notfind=document.getElementsByClassName('notfind');
       if(notfind.length>0){

       }else{
           Pagelist.innerHTML="对不起，没有找到你想要的内容<a  href='/afood/admin/orderlist'>返回列表</a>"
       }


}


      function  del(id,pic,face){
            var datas={'_token':'{{csrf_token()}}','id':id};
          var url='{{url('/admin/orderdelete')}}';
          $.ajax({
              type: "post",
              url: url,
              dataType: "json",
              data: datas,
              success: function(data){
                  if(data['staus']==1){
                      alert(data['msg'])
                  }else {
                      alert(data['msg'])
                  }
                  window.location.href="/afood/admin/orderlist";
              }
          });



        }



</script>
</body>
</html>