<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

//    $router->get('/', 'HomeController@index');

    $router->get('/', 'DataController@index');
    $router->get('essential', 'HomeController@index');

    //商品模块
    $router->resource('categroy', CategoryController::class);//商品分类
    $router->resource('product_type', ProductTypeController::class);//商品类型表
    $router->resource('product',ProductController::class); //添加商品
    $router->resource('product_comment',ProductCommentController::class); //商品评论
    $router->get('product_comment/eachproductcomment/{id}' , 'ProductCommentController@eachproductcomment');//查看每条评论的详情
    $router->get('/api/showAttr' , 'ProductController@showAttr');//ajax请求获得商品属性
    $router->resource('adminproductlidt' , AdminProductController::class);//管理员查看所有店铺的商品
    $router->get('/api/showaboutcomment' , 'ProductCommentController@showaboutcomment');
    $router->resource('about_product', AboutProductController::class);//商品说明
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

    //信息模块
    $router->resource('suggest' , SuggestController::class);//意见反馈
    $router->resource('topic' , TopicController::class);//话题管理

    //网站管理
    $router->resource('menu' , MenuController::class);//菜单栏管理
    $router->resource('footer' , FooterController::class);//脚部信息管理
    $router->resource('advertisement' , AdvertisementController::class);//广告图片管理，包括 幻灯片

    //Api 图片上传
    $router->post('api/uploadImg' , 'UploadImgController@upload');
    $router->get('api/deletedImg' , 'UploadImgController@deletedImg');

    //图标统计
    $router->get('api/count_order_num_by_store' , 'DataController@countOrderNumByStore');//统计用户
});
