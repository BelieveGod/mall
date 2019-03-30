<?php

namespace App\Api\Controllers;

use App\Model\ShoppingCart;
use App\Model\UserCollect;
use Illuminate\Http\Request;

class ShoppingCartController
{
    //加入购物车
    public function addShoppingCart(Request $request)
    {
        $product_id = $request->post('product_id');
        $user_id = $request->post('user_id');
        $num = $request->post('num');

        $shoppingCart = new ShoppingCart();
        $shoppingCart->product_id = $product_id;
        $shoppingCart->user_id = $user_id;
        $shoppingCart->num = $num;
        $shoppingCart->save();

        return 'success';
    }

    //删除购物车
    public function delShoppingCart(Request $request)
    {
//        $collect_id = $request->post('collect_id');
//        $collect = UserCollect::findOrFail($collect_id);
//        $collect->delete();
//        if ($collect->trashed()) {
//            return '该记录已删除';
//        }
    }


}
