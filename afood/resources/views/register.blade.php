
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>register</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <style>
        .form-wraaper{width:100%;height: 100%;}
        .weui-cell{margin-bottom: 10px;}
        .demos-title{margin-left:40%;
            color: #3cc51f;width: 20%;}
        .msg-err{margin-left:30%;
            color: #3cc51f;width: 40%;}
        #getCode{
            width:120px;}
        @media screen and (max-width: 340px) {

            .demos-title{margin-left:40%;
                color: #3cc51f;width: 20%;font-size: 30px;}
            .msg-err{margin-left:40%;
                color: #3cc51f;width: 20%;font-size: 30px;}
            #getCode{width:90px;font-size: 12px;}

        }
    </style>
</head>
<body>
<script src="{{asset('public/js/jquery-2.1.4.js')}}"></script>
<div class="form-wraaper">
    <h1 class="demos-title">注册</h1>
    @if(isset($msg))
        <h4 class="msg-err">{{$msg}}</h4>
    @endif
    <form action="{{url('/regHandle')}}" method="post" >
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden"  name="phoneCode" id="phoneCode" value="1234"/>
        <div class="weui-cells weui-cells_form">
          
            <div class="weui-cell weui-cell_vcode">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="tel" id="phone" name="phone"  placeholder="请输入手机号">
                </div>
            </div>
            <div class="weui-cell weui-cell_vcode">
                <div class="weui-cell__hd">
                    <label class="weui-label">密码</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="password" id="pwd" name="pwd"  placeholder="请输入密码">
                </div>
            </div>
            <div class="weui-cell weui-cell_vcode">
                <div class="weui-cell__hd">
                    <label class="weui-label">验证码</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input"    name="code" type="tel" placeholder="请输入验证码">
                </div>
                <div class="weui-cell__ft">
                    <input type="button" class="weui-btn weui-btn_plain-primary" id="getCode" value="获取验证码">
                </div>
            </div>

        </div>
        <button type="submit"   class="weui-btn weui-btn_primary">确定</button>
      <a  class="weui-btn weui-btn_primary" href="{{url('/login')}}">前往登录</a>
    </form>
</div>

<script>

    $(document).ready(function(){
       $('#getCode').click(  function (){
           var Appkey="46d1752fd11477cc233b7be0d99bd167";
           var url="https://bird.ioliu.cn/v2";
           var rawurl="https://v.apistore.cn/api/v14/send";
           var Phone=parseInt($('#phone').val());
           var num=rd(1000,9999);
           var content="【益匠零食箱子】您的验证码为:"+num;

           var data= {url:rawurl,key:Appkey,mobile:Phone,content:content};

           $.ajax({
               type:"POST",
               url:url,
               data:data,
               dataType:"json",
               success:function(data){
                   if(data.reason=="success"&&data.error_code==0){
                       $('#phoneCode').val(num);
                   }
               }
           });
          
           var countdown=100;
           settime($('#getCode'));
           function settime(val) {
               if (countdown >=0) {
                   val.attr("disabled", true);
                   val.val("重新发送(" + countdown + ")");
                   countdown--;
               }else{
               }
               const timer=window.setTimeout(function() {
                   settime(val)
               },1000);
               if(countdown==-1){
                   clearTimeout(timer);
                   val.attr("disabled",false);
                   val.val("免费获取验证码");
               }
           }
       });

       function rd(n,m){
           var c = m-n+1;
           return Math.floor(Math.random() * c + n);
       }
   })
</script>
</body>
</html>
