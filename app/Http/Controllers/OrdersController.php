<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Regions;
use App\Model\ShoppingCart;
use App\Model\UserAddress;
use Illuminate\Support\Facades\Auth;

class OrdersController extends HomeController
{
    //显示购物车页面
    public function index()
    {
        $product = [];
        $store = [];
        //获取用户id
        $user_id = Auth::user()->id;
        //显示用户地址
        $user_address = UserAddress::findUserAddress($user_id);
        //显示要支付的商品
        $cart_id = \request()->all();

        //如果提交空表单 跳转到当前页面
        if(!$cart_id){
            return back();
        }

        foreach ($cart_id as $value){
            $product[] = ShoppingCart::where('shopping_cart_id' , $value)->first()->toArray();
        }
        //涉及到的商店
        $store_arr = array_unique(array_column($product,'store_id'));
        $temp = [];
        foreach ($store_arr as $value){
            $temp['store_id'] = $value;
            $store[] = $temp;
        }
        $order = ShoppingCart::displayProduct($store , $product);

        return view('Home.Orders',[
            'user_address' => $user_address ,
            'order' => $order,
        ]);
    }
}