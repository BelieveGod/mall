<?php

namespace App\Model;


class ProductSku extends Common
{
    protected $table = 'product_sku';
    protected $primaryKey = 'sku_id';
    //白名单
    protected $fillable = ['product_id' , 'price' , 'num' , 'sku_attr' , 'sku_val'];

    //根据sku_id查找商品的属性及属性值
    public static function findskuvaluebyskuid($sku_id)
    {
        $sku_val = ProductSku::where('sku_id' , $sku_id)->value('sku_val');
        $sku_val = explode('_' , $sku_val);
        $sku_attr = ProductSku::where('sku_id' , $sku_id)->value('sku_attr');
        $sku_attr = explode('_' , $sku_attr);
        $num = count($sku_attr);
        $str = '';
        for($i=0 ; $i<$num ; $i++){
            $attr = ProductAttr::where('attr_id' , $sku_attr[$i])->value('attr_name');
            $attr_val = ProductAttrValue::where('attr_value_id' , $sku_val[$i])->value('attr_value_name');
            $str .= $attr.' : '.$attr_val.'&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $str;
    }
}
