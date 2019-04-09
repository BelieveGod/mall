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

Route::get('/', function () {
    return view('welcome');
});
//首页
Route::get('home_index' , 'IndexController@index');
//登陆
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//用户信息
Route::get('userInfo' , 'UserInfoController@index');//个人信息
Route::get('resetPassword' , 'UserInfoController@resetPassword');//修改密码
Route::get('userForm' , 'UserInfoController@userForm');//我的订单
Route::get('userIntegral' , 'UserInfoController@userIntegral');//我的积分
Route::get('userCollect' , 'UserInfoController@userCollect');//我的收藏
Route::get('userAddress/{id?}' , 'UserInfoController@userAddress');//收货地址

//购物车
Route::get('shoppingCart' , 'ShoppingCartController@index');//显示购物车样式
Route::get('addShoppingCartLogin/{id}' , 'ShoppingCartController@addShoppingCartLogin');//显示购物车样式

//商品列表
Route::get('product' , 'ProductController@index');//所有商品
Route::get('productList/{id}' , 'ProductListController@index');//商品列表
Route::get('productDetailed/{id}' , 'ProductDetailedController@detailed');//商品详情

//活动中心
Route::get('groupBuy' , 'GroupBuyController@index');//商品详情

//联系我们
Route::get('callAboutUs' , 'CallAboutUsController@index');//联系我们
Route::get('mySuggest' , 'CallAboutUsController@mySuggest');//我的建议

//商家入驻申请
Route::get('applyAdmin' , 'ApplyAdminController@index');//商家提交申请
Route::post('web/api/addApply' , 'ApiValidatorController@addApply');//提交申请
Route::get('applySuccess' , 'ApplyAdminController@applySuccess');//商家提交申请成功页面
Route::get('findApplyAdmin' , 'ApplyAdminController@findApplyAdmin');//商家查询申请结果
Route::get('updatedApplyAdmin/{id?}' , 'ApplyAdminController@updatedApplyAdmin');//商家修改

//提交商品订单
Route::get('orders' , 'OrdersController@index');//提交商品订单


