<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    //商品模块
    $router->resource('categroy', CategoryController::class);//商品分类
    $router->resource('product_type', ProductTypeController::class);//商品类型表
    $router->resource('product',ProductController::class); //添加商品
    $router->resource('product_comment',ProductCommentController::class); //商品评论
    $router->get('product_comment/eachproductcomment/{id}' , 'ProductCommentController@eachproductcomment');//查看每条评论的详情
    $router->get('/api/showAttr' , 'ProductController@showAttr');//ajax请求获得商品属性
    $router->any('adminproductlidt' , 'ProductController@adminproductlidt');//管理员查看所有店铺的商品
    $router->get('/api/showaboutcomment' , 'ProductCommentController@showaboutcomment');
    //订单模块
    $router->resource('business_address' , BusinessAddressController::class);//发货地址
    $router->get('api/getregion' , 'RegionsController@getRegion');//选择地区联动
    $router->get('/api/map/{name}/{value?}','GaodeMapController@index');//高德地图
    $router->resource('productform' , ProductFormController::class);//订单管理

    //商家及用户
    $router->resource('store' , StoreController::class);//商家入驻管理
    $router->resource('member' , MemberController::class);//商城用户管理
    $router->post('store/blacklist', 'StoreController@putblacklist');//商家黑名单
    $router->post('member/blacklist', 'MemberController@putblacklist');//用户黑名单管理
    $router->get('/store/blackliststorelist' , 'StoreController@blackliststorelist');
    $router->get('menmber/blackliststorelist' , 'MemberController@blacklistmemberlist');
});
