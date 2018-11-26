<!DOCTYPE html>
<html>
<head>
<title>支付页面</title>
<meta charset="utf-8" />
<meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="{{asset('resources/views/css/wxzf.css')}}">
<script src="{{asset('resources/views/js/jquery.js')}}"></script>
</head>
<body>
<div class="wenx_xx">
  <div class="mz">益匠零食箱子</div>
  <div class="wxzf_price">￥{{$price}}</div>
</div>
<div class="skf_xinf">
  <div class="all_w"> <span class="bt">商品列表</span> <span class="fr">{{$foodlist}}</span> </div>
</div>
<div class="skf_xinf">
  <div class="all_w"> <span class="bt">公司</span> <span class="fr">益匠零食箱子</span> </div>
</div>
<a href="javascript:void(0);" class="ljzf_but all_w" id="btnPay">前往支付</a> 

<!--浮动层-->


  <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> 
<script> 
    $(function(){  
  $("#btnPay").click(function(){  
     $.ajax({
             type: "POST",
             url: "{{url('/desgood')}}",
             data: {'foodlist':'{{$foodlist}}','_token':'{{csrf_token()}}','phone':'{{$case['phone']}}','price':'{{$price}}'},
             dataType: "json",
             success: function(data){
                        if(data==1){
                          alert('支付成功')
                        window.location.href="{{url('/good')}}"
                      }else{
                         console.log('失败'); 
                      }
                    }
         });
          
      });
return false;



        });  
</script>  

</body>
</html>
    