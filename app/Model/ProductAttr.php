<?php

namespace App\Model;

class ProductAttr extends Common
{
    protected $table = 'product_attr';
    protected $primaryKey = 'attr_id';
    //白名单
    protected $fillable = ['attr_name'];

    public function productType()
    {
        return $this->belongsTo(ProductType::class , 'type_id');
    }
}
