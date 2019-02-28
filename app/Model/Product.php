<?php

namespace App\Model;

class Product extends Common
{
    //
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    //多图上传
    public function setProductMasterImgAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['product_master_img'] = json_encode($pictures);
        }
    }
    public function getProductMasterImgAttribute($pictures)
    {
        return json_decode($pictures, true);
    }
    public static function findProductNameById()
    {
        return Product::pluck('product_name' , 'product_id')->toArray();
    }
}
