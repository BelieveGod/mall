<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;

class ShoppingCartController extends HomeController
{
    //显示购物车页面
    public function index()
    {
        return view('Home.shoppingCart');
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