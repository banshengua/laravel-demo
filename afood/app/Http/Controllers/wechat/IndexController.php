<?php

namespace App\Http\Controllers\wechat;

use App\Fd_cate;
use App\Fd_food;
use App\Weuser;
use App\Total;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Request;
class IndexController extends Controller
{
   public  function good(){
  // $openid='o5Y0Q1oEu2JEe-D9s5jqds-Gxmjg';  
       $data=Fd_food::join('fd_cate','fd_cate.id','=','fd_food.pid')->select('fd_cate.id','fd_cate.cate_name', 'fd_food.name','fd_food.price','fd_food.img','fd_food.sellcount','fd_food.surplus')->get();
       $cate=Fd_cate::get();
        foreach($cate as $item){
            $foods=[];
            foreach($data as $value){
                if($value['cate_name']==$item['cate_name']){
                    $food['name']=$value['name'];
                    $food['price']=$value['price'];
                    $food['sellcount']=$value['sellcount'];
                    $food['surplus']=$value['surplus'];
                     $food['img']=$value['img'];
                    array_push($foods,$food);
                }
            }
        
            $item['foods']=$foods;
        }
       return $cate;
   }
   public function user(){
 $phone=Session::get('phone');
 //$openid='o5Y0Q1oEu2JEe-D9s5jqds-Gxmjg';
    $user=Weuser::where('phone',$phone)->first();
    return $user;
   }
   public function totalFood(){  
       $data=Total::join('fd_cate','fd_cate.id','=','total_food.pid')->select('fd_cate.id','fd_cate.cate_name','total_food.fd_name','total_food.fd_price','total_food.img','total_food.fd_sellcount'
       ,'total_food.fd_surpuls')->get();
    
       $cate=Fd_cate::get();

        foreach($cate as $item){
            $foods=[];
            foreach($data as $value){
                if($value['cate_name']==$item['cate_name']){
                    $food['name']=$value['fd_name'];
                    $food['price']=$value['fd_price'];
                    $food['sellcount']=$value['fd_sellcount'];
                    $food['surplus']=$value['fd_surpuls'];
                     $food['img']=$value['img'];
                    array_push($foods,$food);
                }
            }
        
            $item['foods']=$foods;
        }
       return $cate;

   }
}
