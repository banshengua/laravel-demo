<?php

namespace App\Http\Controllers\wechat;

use App\Wecase;
use App\Weuser;
use App\Fd_food;
use App\Fd_user;
use App\Total;
use App\Userec;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Factory;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Request;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\Media;
use EasyWeChat\Kernel\Messages\Article;
class WechatController extends Controller
{
public function login()
    {
        return view('login');
    }
public function loginHandle(Request $request)
    {
        $data=Request::all();

        if($data['pwd']==null||$data['phone']==null){
            $msg="登录失败不要留空";
        
            return view('login',['msg'=>$msg]);
        }else{
            $res=Weuser::where([['phone',$data['phone']],['pwd',$data['pwd']]])->first();
            if(isset($res->phone)){
               Session::put('msg', 'success');
                 Session::put('phone',$data['phone']);       
                 return redirect("good");
            }else{
            $msg="用户和密码不一致";
        
            return view('login',['msg'=>$msg]);

            }

        }


    }

    public function register()
    {
        return view('register');
    }
    public function regHandle(Request $request){
        $data=Request::all();
        if($data['pwd']==null||$data['phone']==null){
            $msg="注册失败不要留空";
        
            return view('register',['msg'=>$msg]);
        }else{
            $res2=Weuser::where('phone',$data['phone'])->first();
                if(isset($res2->phone)){
            $msg="该手机已被注册";
            return view('register',['msg'=>$msg]);

                }

            if($data['phoneCode']==$data['code']){
                $user=new Weuser();
                $user->phone=$data['phone'];
                $user->pwd=$data['pwd'];
                $res1=$user->save();
                Session::put('msg', 'success');
                 Session::put('phone',$data['phone']);
               
                if(isset($res1)){
                     return redirect("good");
                }
            }else{
                $msg="注册失败请检查验证码";
                return view('register',['msg'=>$msg]);
            }
        }
    }
    //food表添加        
    //   
    public function Defood($case){
        $result=Fd_food::where('case',$case)->first();
        if(isset($result)){
            return true;
        }else{
            $datas=Total::all();
            for($i=0;$i<count($datas);$i++)
            {
               $name[$i]= $datas[$i]['fd_name'];
               $price[$i]=$datas[$i]['fd_price'];
               $img[$i]=$datas[$i]['img'];
               $sellcount[$i]=$datas[$i]['fd_sellcount'];
                $caseSurplus=[1,2,1,2,2,1,1,4,4,2,1,1,1,0,1,2,1,1];//和总货物内容一致对应数量
                $surplus[$i]=$caseSurplus[$i];//分配货物数量
                $pid[$i]=$datas[$i]['pid'];
            }    
    
          //   $name=['袋装','桶装','熊字饼','手指饼','馍丁','大面筋','魔芋爽','咪咪虾条',
          // '亲嘴烧','小鱼仔','小米锅巴','AD钙','蛋黄派'];
          // $price=[5,10,2,5,6,3,3,5,0.5,2.5,3,2.5,1.5];
          // $img=['uploads/noodle2.png','uploads/noodle1.png','uploads/cookie2.png','uploads/cookie1.png','uploads/cookie3.png','uploads/joke3.png','uploads/joke4.png','uploads/joke6.png','uploads/joke1.png','uploads/joke2.png',
          // 'uploads/joke5.png','uploads/juice1.png','uploads/cake1.png'];
          // $sellcount=[100,100,10,52,10,200,210,123,111,12321,111,120,121];    
          // $pid=[1,1,2,2,2,3,3,3,3,3,3,4,5];
          $case=$case;
          for($i=0;$i<count($name);$i++){
               $food=new Fd_food();
                $food->name=$name[$i];
                $food->price=$price[$i];
                $food->img=$img[$i];
                $food->sellcount=$sellcount[$i];
                $food->pid=$pid[$i];
                $food->surplus=$surplus[$i];
                $food->case=$case;
                $res=$food->save();
                if(!isset($res)){
                    break;
                } 
          }
          return 1;

        }
         

    }
    public function good(){
        return view('good/good');
    }
    //支付
    public function pay(){
 $datas=Request::all();    
$foodlist='';
$foodName=explode(',',$datas['foodName']);
$foodNum=explode(',',$datas['foodNum']);
for($i=0;$i<count($foodName);$i++){
    $foodlist.=$foodName[$i].'X'.$foodNum[$i].',';
}
$case=Weuser::where('phone',$datas['openid'])->first();
   return view('pay',['price'=>$datas['Price'],'case'=>$case,'foodlist'=>$foodlist]);
    }
    public function desgood(){
       $datas=Request::all();
        $foodlist=$datas['foodlist'];
        $userec=new Userec();
        $userec->rec_list=$datas['foodlist'];
        $userec->rec_price=$datas['price'];
        $userec->rec_time=date("Y.m.d");
        $userec->rec_phone=$datas['phone'];
        $userec->save();
        $foodlist=explode(',',$foodlist);
        $weuser=Weuser::where('phone',$datas['phone'])->first();
        $price=$datas['price']+$weuser['pay'];

        $rel2=Weuser::where('phone',$datas['phone'])->update(['pay'=>$price]);
        for($i=0;$i<count($foodlist)-1;$i++){
            $food=explode('X',$foodlist[$i]);
            $foodName[$i]=$food[0];
            $foodNum[$i]=$food[1];
        }
      for($i=0;$i<count($foodName);$i++){
        $food=Fd_food::where('name',$foodName[$i])->first();
        $food->surplus=$food->surplus-$foodNum[$i];
       $rel=$food->save();
      }
       if($rel&&$rel2){
        return 1;
        }else{
        return 0;
       }
    }




    public function case($openid){
$app=app('wechat.official_account');
 $list = $app->material->list('news', 0, 1);

        foreach ($list['item'] as $key => $value) {
                          $media_id=$value['media_id'];
                       }   
                $media = new Media($media_id, 'mpnews');
  $app->customer_service->message($media)->to($openid)->send();
 // $article = new Article([
 //    'title' => 'xxx',
 //    'thumb_media_id' => $mediaId,
 //    //...
 //  ]);
// $app->material->uploadArticle($article);

    }

}
