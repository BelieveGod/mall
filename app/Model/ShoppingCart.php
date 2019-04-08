<?php

namespace App\Model;

class ShoppingCart extends Common
{
    //
    protected $table = 'shopping_cart';
    protected $primaryKey = 'shopping_cart_id';

    /**
     * 查找每个用户的购物车
     * @param $user_id
     * @return array
     */
    public static function findUserShoppingCart($user_id)
    {
        //查看过购物车的商品
        $product = ShoppingCart::where('user_id' , $user_id)->get()->toArray();
        //如果用户购物车里没有东西则返回
        if(empty($product)){
            return [];
        }
        //涉及到的商店 SELECT store_id FROM mall_shopping_cart GROUP BY store_id
        $store = ShoppingCart::select('store_id')->where('user_id' , $user_id)->groupBy('store_id')->get()->toArray();
        //数据处理 方便前台打印数据
        $data = [];
        foreach ($store as $value){
            $temp = [];
            foreach ($value as $k=>$v){
                $temp[$k] = Store::where('admin_id' , $v)->first()->toArray();
                foreach ($product as $pro){
                    $pro['product'] = Product::where('product_id' , $pro['product_id'])->first()->toArray();
                    $pro['product']['cost'] = $pro['product']['present_price']*$pro['num'];
                    if($v == $pro['store_id']){
                        $temp['product'][] = $pro;
                    }
                }
            }
            $data[] = $temp;
        }
        return $data;
    }
}
