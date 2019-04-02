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

//联系我们
Route::post('/upSuggest' , 'SuggestController@upSuggest');//意见反馈

//收藏夹
Route::post('/addCollect' , 'UserCollectController@addCollect');//加入收藏夹
Route::post('/delCollect' , 'UserCollectController@delCollect');//删除收藏夹的商品

//购物车
Route::post('/addShoppingCart' , 'ShoppingCartController@addShoppingCart');//加入购物车
Route::post('/delShoppingCart' , 'ShoppingCartController@delShoppingCart');//删除购物车

//商家申请供应
//Route::post('/addApply' , 'ApplyAdminController@addApply');//提交申请 放到web里面
Route::post('/applyAdminUploadImg' , 'ApplyAdminController@uploadImg');//图片上传
Route::get('/applyAdminDeletedImg' , 'ApplyAdminController@deletedImg');//删除图片