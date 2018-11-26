<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\wechat\Controller;
use App\Fd_food;
use App\Fd_cate;
use App\Admin;
use App\Weuser;
use App\Userec;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ReviewController extends Controller
{
  public function catelist(){
$datas=Fd_cate::paginate(4);

    return view('admin/catelist',['datas'=>$datas]);
  }
public function catedelete(Request $request){
  $data=$request->input();
   $rel=fd_cate::where('id','=',$data['id'])->delete();
        if($rel){
            $data=['staus'=>1,'msg'=>'删除成功'];
            return $data;
        }else{
            $data=['staus'=>0,'msg'=>'删除失败'];
            return $data;
        }
}
public function cateupdate($id)
    {
      $data=Fd_cate::where('id',$id)->first();
        return view('admin/addBill',['data'=>$data]);
    }
public function cateupdateHandle(Request $request)
    {
      $newData=$request->input();
      $data=['cate_name'=>$newData['cate']];
      $rel=Fd_cate::where('id',$newData['id'])->update($data);
      if($rel){
       return redirect('admin/catelist'); 
      }
        else{
          return  redirect()->back();
        }
        
    }
    public function catekeyword(Request $request){
      $data=$request->input();
     $datas=Fd_cate::where('cate_name', 'like','%'.$data['keyword'].'%')->paginate(4);
     return view('admin/catelist',['datas'=>$datas]);
    }
    public function listReq(){
        return view('admin/backindex');
      } 
    public function add()
    {
        return view('admin/addBill');
    }
 public function addHandle(Request $request)
    {$data=new Fd_cate();
        $newData=$request->input();

        $rel1=Fd_cate::where('cate_name',$newData['cate']);
        if(isset($rel1->id)){
          echo "<script>alert('分类名已经存在')</script>";

          return redirect()->back();
        }
        
        $data->cate_name=$newData['cate'];
         $rel=$data->save();

         if(isset($rel)){
           return redirect('admin/catelist');
         }else{
          return redirect()->back();
         }
       
    }
    //用户
 public function adduser()
    {
        return view('admin/adduser');
    }
public function adduserHandle(Request $request)
    {$data=new Weuser();
        $newData=$request->input();

        $rel1=Weuser::where('phone',$newData['phone']);

        if(!isset($rel1->id)){
        $request->session()->flash('err', '用户名已存在');
          return redirect()->back();
        }
        
        $data->phone=$newData['phone'];
           $data->pwd=$newData['pwd'];
         $rel=$data->save();

         if(isset($rel)){
           return redirect('admin/userlist');
         }else{
          return redirect()->back();
         }
       
    }
    public function userlist(){
$datas=Weuser::paginate(6);

    return view('admin/userlist',['datas'=>$datas]);
  }
public function userdelete(Request $request){
  $data=$request->input();
   $rel=Weuser::where('id','=',$data['id'])->delete();
        if($rel){
            $data=['staus'=>1,'msg'=>'删除成功'];
            return $data;
        }else{
            $data=['staus'=>0,'msg'=>'删除失败'];
            return $data;
        }
}
public function userupdate($id)
    {
      $data=Weuser::where('id',$id)->first();
        return view('admin/adduser',['data'=>$data]);
    }
public function userupdateHandle(Request $request)
    {
      $newData=$request->input();
      $data=['pwd'=>$newData['pwd'],'phone'=>$newData['phone']];
      $rel=Weuser::where('id',$newData['id'])->update($data);
      if($rel){
       return redirect('admin/userlist'); 
      }
        else{
          return  redirect()->back();
        }
        
    }
      public function userkeyword(Request $request){
      $data=$request->input();
     $datas=Weuser::where('phone', 'like','%'.$data['keyword'].'%')->paginate(4);
     return view('admin/userlist',['datas'=>$datas]);
    }
//订单
public function orderlist(){
$datas=Userec::paginate(10);

    return view('admin/orderlist',['datas'=>$datas]);
  }
public function orderdelete(Request $request){
  $data=$request->input();
   $rel=Userec::where('rec_id','=',$data['id'])->delete();
        if($rel){
            $data=['staus'=>1,'msg'=>'删除成功'];
            return $data;
        }else{
            $data=['staus'=>0,'msg'=>'删除失败'];
            return $data;
        }
}
    public function orderkeyword(Request $request){
      $data=$request->input();
     $datas=Userec::where('rec_phone', 'like','%'.$data['keyword'].'%')->paginate(4);
     return view('admin/orderlist',['datas'=>$datas]);
    }
   //食物
    public function addfood()
    {
      $cates=Fd_cate::get();
        return view('admin/addfood',['cates'=>$cates]);
    }
 public function addfoodHandle(Request $request)
    {
       $data = $request->input();
         
        $file = $request->file('pic');
        $rel1=Fd_food::where('name',$data['name'])->first();
        if(isset($rel1->id)){
          $request->session()->flash('err', '商品已存在');
          return redirect()->back();
        }
        if ($file->isValid()) {

            $clientName = $file->getClientOriginalName();
            $tmpName = $file->getFilename();
            $realPath = $file->getRealPath();
            $ext = $file->getClientOriginalExtension();
            $mimeType = $file->getClientMimeType();
            $newName = date('Y-m-d-h-i-s') . uniqid() . '.' . $ext;
            $bool = Storage::disk('uploads')->put($newName, file_get_contents($realPath));
           $Fd_food=new Fd_food();
            $Fd_food->name = $data['name'];
            $Fd_food->price = $data['price'];
            $Fd_food->sellcount = $data['sellcount'];
             $Fd_food->surplus = $data['surplus'];
            $Fd_food->img = 'uploads/' . $newName;
            $Fd_food->pid=$data['cate'];
            $result = $Fd_food->save();
            if ($result) {
                return redirect('admin/foodlist');
            }else{
              return redirect()->back();
            }
        }

       
    } 

    public function foodlist(){
       $datas= Fd_food::paginate(8);
       return view('admin/foodlist',['datas'=>$datas]);
    }
    public function fooddelete(Request $request){
  $data=$request->input();
  $ad= Fd_food::where('id',$data['id'])->first();
     $path=dirname(dirname(dirname(dirname(dirname(__FILE__)))))."\\".str_replace('/','\\',$ad['img']);
        $res1= unlink($path);
   $rel=Fd_food::where('id','=',$data['id'])->delete();
        if($rel&&$res1){
            $data=['staus'=>1,'msg'=>'删除成功'];
            return $data;
        }else{
            $data=['staus'=>0,'msg'=>'删除失败'];
            return $data;
        }
}
public function foodkeyword(Request $request){
      $data=$request->input();
     $datas=Fd_food::where('name', 'like','%'.$data['keyword'].'%')->paginate(8);
     return view('admin/foodlist',['datas'=>$datas]);
}
public function foodupdate($id)
    {
      $data=Fd_food::where('id',$id)->first();
      $cates=Fd_cate::get();
        return view('admin/addfood',['data'=>$data,'cates'=>$cates]);
    }
public function foodupdateHandle(Request $request)
    {
      $data=$request->input();
      $file = $request->file('pic');
        if(isset($file)){
      $ad= Fd_food::where('id',$data['id'])->first();  
      $path=dirname(dirname(dirname(dirname(dirname(__FILE__)))))."\\".str_replace('/','\\',$ad['img']);
        $res1= unlink($path);
        if ($file->isValid()) 
        {

            $clientName = $file->getClientOriginalName();
            $tmpName = $file->getFilename();
            $realPath = $file->getRealPath();
            $ext = $file->getClientOriginalExtension();
            $mimeType = $file->getClientMimeType();
            $newName = date('Y-m-d-h-i-s') . uniqid() . '.' . $ext;
            $bool = Storage::disk('uploads')->put($newName, file_get_contents($realPath));

          $Newdata=['name'=>$data['name'],'price'=>$data['price'],
          'sellcount'=>$data['sellcount'],'img'=>'uploads/' . $newName,
          'pid'=>$data['cate'],'surplus'=>$data['surplus']];
      $rel=Fd_food::where('id',$data['id'])->update($Newdata);
      if($rel&&$res1){
       return redirect('admin/foodlist'); 
      }
      else{
          return  redirect()->back();
        }


            
        } 

     }else{

          $Newdata=['name'=>$data['name'],'price'=>$data['price'],
          'sellcount'=>$data['sellcount'],
          'pid'=>$data['cate'],'surplus'=>$data['surplus']];
      $rel=Fd_food::where('id',$data['id'])->update($Newdata);
      if($rel){
       return redirect('admin/foodlist'); 
      }
      else{
          return  redirect()->back();
        }


     }
        



     
      
        
    }



    public function login(){
        return view('admin/login');
    }
    public function loginHandle(Request $request){
        $data=$request->input();
          $rel1=Admin::where('admin_name',$data['name'])->where('admin_pwd',$data['password'])->first();
        if(isset($rel1)){
            Session::put('status', 'success');
            return redirect('admin/list');
        }else{
            $msg='密码或用户错误';
            Session::flash('log-msg',$msg);
            return redirect()->back();
        }
    }
  
}
