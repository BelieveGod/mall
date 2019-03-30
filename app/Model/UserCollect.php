<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserCollect extends Common
{
    //
    protected $table = 'user_collect';
    protected $primaryKey = 'collect_id';

    public static function findAllUserCollect($user_id)
    {
        //查出 商品
//        $collect = UserCollect::where('user_id' , $user_id)->paginate(6);
//        foreach ($collect as $value){
//            $product = Product::where('product_id' , $value['product_id'])->first()->toArray();
//            $value['product_id'] = $product;
//        }
        //左联 找出商品 分页 6个商品为一页
        $collect = UserCollect::where('user_id' , $user_id)->leftJoin('product'  ,'user_collect.product_id','product.product_id')->paginate(6);

        return $collect;
    }
    public function getProductMasterImgAttribute($pictures)
    {
        return json_decode($pictures, true);
    }

}
