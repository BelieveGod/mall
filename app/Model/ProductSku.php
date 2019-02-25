<?php

namespace App\Model;


class ProductSku extends Common
{
    protected $table = 'product_sku';
    protected $primaryKey = 'sku_id';
    //白名单
    protected $fillable = ['product_id' , 'price' , 'num' , 'sku_attr' , 'sku_val'];
}
