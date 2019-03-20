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
Route::get('shoppingCart' , 'ShoppingCartController@index');

//商品列表
Route::get('productList' , 'ProductListController@index');

