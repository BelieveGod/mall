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
    $router->get('/api/showAttr' , 'ProductController@showAttr');
    //订单模块
    $router->resource('business_address' , BusinessAddressController::class);//发货地址
    $router->get('api/getregion' , 'RegionsController@getRegion');//选择地区联动
    $router->get('/api/map/{name}/{value?}','GaodeMapController@index');//高德地图
    $router->resource('productform' , ProductFormController::class);

    //商家及用户
    $router->resource('store' , StoreController::class);
    $router->resource('member' , MemberController::class);
    $router->post('store/blacklist', 'StoreController@putblacklist');
    $router->post('member/blacklist', 'MemberController@putblacklist');
    $router->get('/store/blackliststorelist' , 'StoreController@blackliststorelist');
    $router->get('menmber/blackliststorelist' , 'MemberController@blacklistmemberlist');
});
