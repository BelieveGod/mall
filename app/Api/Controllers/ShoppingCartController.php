<?php

namespace App\Api\Controllers;

use App\Model\ShoppingCart;
use App\Model\UserCollect;
use Illuminate\Http\Request;

class ShoppingCartController
{
    //加入购物车
    public function addShoppingCart()
    {
        $product_id = \request('product_id');
        $user_id = \request('user_id');
        $num = \request('num');
        $store_id = \request('store_id');

        //先判断数据库中 该该用户的购物车是否已经有该商品
        $inShoppingCart = ShoppingCart::where([['user_id' , $user_id] , ['product_id' , $product_id]])->first();
        if($inShoppingCart){
            //如果商品存在 则商品数量加1
            $shoppingCart = ShoppingCart::find($inShoppingCart->shopping_cart_id);
            $shoppingCart->num = $inShoppingCart->num + 1;
        }else{
            //该商品不存在 创建该商品
            $shoppingCart = new ShoppingCart;
            $shoppingCart->product_id = $product_id;
            $shoppingCart->user_id = $user_id;
            $shoppingCart->num = $num;
            $shoppingCart->store_id = $store_id;
        }
        $shoppingCart->save();
        //如果数据存在的就不要再添加了(因为num这个字是不变的,不能用该方法)
//        $shoppingCart = ShoppingCart::updateOrCreate(
//            ['user_id' => $user_id, 'product_id' => $product_id]
//            ,['num' => (int)$num + 1]
//        );
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
