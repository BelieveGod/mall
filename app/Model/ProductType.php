<?php

namespace App\Model;

class ProductType extends Common
{
    protected $table = 'product_type';
    protected $primaryKey = 'type_id';

    public function productAttr()
    {
        return $this->hasMany(ProductAttr::class , 'type_id');
    }

    public static function findTypeId()
    {
        return ProductType::pluck('type_name' , 'type_id');
    }

}
