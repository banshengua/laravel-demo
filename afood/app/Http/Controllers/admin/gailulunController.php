<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\wechat\Controller;

class gailulunController extends Controller
{
    
    public function index(){
    	return view('gailulun');
    }
    public function indexHandle($id){
    	if($id==1)
    	$imgs=['uploads/1-1.jpg','uploads/1-2.jpg','uploads/1-3.jpg','uploads/1-4.jpg'];
    	elseif ($id==2) {
    	$imgs=['uploads/2-1.jpg','uploads/2-2.jpg','uploads/2-3.jpg','uploads/2-4.jpg','uploads/2-5.jpg'];
    	}
    	elseif ($id==3) {
    	$imgs=['uploads/3-1.jpg','uploads/3-2.jpg','uploads/3-3.jpg','uploads/3-4.jpg','uploads/3-5.jpg'];
    	}elseif ($id==4) {
    		$imgs=['uploads/4-1.jpg','uploads/4-2.jpg'];
    	}
    	elseif ($id==5) {
    		$imgs=['uploads/5-1.jpg'];
    	}
    	elseif ($id==6) {
    		$imgs=['uploads/6-1.jpg','uploads/6-2.jpg','uploads/6-3.jpg','uploads/6-4.jpg'];
    	}
    	elseif ($id==7) {
    		$imgs=['uploads/7-1.jpg','uploads/7-2.jpg','uploads/7-3.jpg','uploads/7-4.jpg'];
    	}
        elseif($id==0){
            $imgs=['uploads/0-1.jpg','uploads/0-2.jpg','uploads/0-3.jpg','uploads/0-4.jpg'];
        }
    	return view('gaidetail',['imgs'=>$imgs]);


    }
}
