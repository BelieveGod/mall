<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Product;
use App\Model\ShoppingCart;
use App\Model\Store;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends HomeController
{
    //显示购物车页面
    public function index()
    {
        //获取登陆的用户
        $user_id = Auth::user()->id;
        $shoppingCart = ShoppingCart::findUserShoppingCart($user_id);
//        dd($shoppingCart);
        return view('Home.shoppingCart',['shoppingCart'=>$shoppingCart]);
    }

    //如果没有登陆 直接跳到登陆界面 然后再跳回本页面
    public function addShoppingCartLogin($id){
        if($id){
            return redirect('/productList/'.$id);
        }else{
            return redirect('/product');
        }

    }
}