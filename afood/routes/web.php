<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'wechat','middleware' => 'Checkuser'], function(){

    Route::get('/good', 'WeChatController@good');
    Route::get('/case', 'WeChatController@case');
    Route::get('/api/good', 'IndexController@good');
     Route::get('/api/user', 'IndexController@user');
     Route::get('/api/totalfood', 'IndexController@totalFood');

    Route::post('/api/userReq', 'IndexController@userReq');
    Route::post('/pay', 'WeChatController@pay');
     Route::post('/desgood', 'WeChatController@desgood');
});

Route::group(['namespace' => 'admin','middleware' => 'checkLogin'], function(){
     Route::get('/admin/add', 'ReviewController@add');
    Route::post('/admin/addHandle', 'ReviewController@addHandle');
Route::any('/admin/list', 'ReviewController@listReq');
Route::get('/admin/catelist', 'ReviewController@catelist');
 Route::get('/admin/cateupdate/{id}', 'ReviewController@cateupdate');
    Route::post('/admin/cateupdateHandle', 'ReviewController@cateupdateHandle');
     Route::post('/admin/catelist/keyword', 'ReviewController@catekeyword');
    Route::post('/admin/catedelete', 'ReviewController@catedelete');
     Route::get('/admin/adduser', 'ReviewController@adduser');
      Route::post('/admin/adduserHandle', 'ReviewController@adduserHandle');
      Route::get('/admin/userlist', 'ReviewController@userlist');
 Route::get('/admin/userupdate/{id}', 'ReviewController@userupdate');
    Route::post('/admin/userupdateHandle', 'ReviewController@userupdateHandle');
     Route::post('/admin/userlist/keyword', 'ReviewController@userkeyword');
    Route::post('/admin/userdelete', 'ReviewController@userdelete');
        Route::get('/admin/orderlist', 'ReviewController@orderlist');
           Route::post('/admin/orderlist/keyword', 'ReviewController@orderkeyword');
    Route::post('/admin/orderdelete', 'ReviewController@orderdelete');


      Route::get('/admin/addfood', 'ReviewController@addfood');
      Route::post('/admin/addfoodHandle', 'ReviewController@addfoodHandle');
      Route::get('/admin/foodlist', 'ReviewController@foodlist');
 Route::get('/admin/foodupdate/{id}', 'ReviewController@foodupdate');
    Route::post('/admin/foodupdateHandle', 'ReviewController@foodupdateHandle');
     Route::post('/admin/foodlist/keyword', 'ReviewController@foodkeyword');
    Route::post('/admin/fooddelete', 'ReviewController@fooddelete');
//概率论
});
Route::get('/admin/login', 'admin\ReviewController@login');
Route::post('/admin/loginHandle', 'admin\ReviewController@loginHandle');
   Route::any('/register', 'wechat\WeChatController@register');//服务器
    Route::post('/regHandle', 'wechat\WeChatController@regHandle');
      Route::any('/login', 'wechat\WeChatController@login');//服务器
    Route::post('/loginHandle', 'wechat\WeChatController@loginHandle');


Route::get('/', function () {
    return view('welcome');
});
Route::get('/gailulun','admin\gailulunController@index');
Route::get('/gailulun/{id}','admin\gailulunController@indexHandle');



