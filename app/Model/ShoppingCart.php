<?php

namespace App\Model;

class ShoppingCart extends Common
{
    //
    protected $table = 'shopping_cart';
    protected $primaryKey = 'shopping_cart_id';

    //查找每个用户的购物车
    public static function findUserShoppingCart($user_id)
    {
        $product = ShoppingCart::where(['user_id' , $user_id])->get();
    }
}
