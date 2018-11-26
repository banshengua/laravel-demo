
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
    <h1 class="demos-title">登录</h1>
    @if(isset($msg))
        <h4 class="msg-err">{{$msg}}</h4>
    @endif
    <form action="{{url('/loginHandle')}}" method="post" >
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
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
        </div>
        <button type="submit"   class="weui-btn weui-btn_primary">登录</button>
      <a  class="weui-btn weui-btn_primary" href="{{url('/register')}}">前往注册</a>
    </form>
</div>

</body>
</html>
