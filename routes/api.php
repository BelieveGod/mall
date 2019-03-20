<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//用户个人详细信息
Route::post('/up_user_info' , 'UserInfoController@upUserInfo');//个人信息
Route::post('/uploadImg' , 'UserInfoController@uploadImg');//图片上传
Route::post('/postReset' , 'UserInfoController@postReset');//修改密码
Route::post('/addAddress' , 'UserAddressController@addAddress');//添加地址
Route::get('/deletedAddress/{id}' , 'UserAddressController@deletedUserAddress');//删除地址