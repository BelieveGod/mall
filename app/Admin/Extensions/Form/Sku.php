<?php

namespace App\Admin\Extensions\Form;

use App\Model\ProductType;
use Encore\Admin\Form\Field;
use Illuminate\Http\Request;

class Sku extends Field
{
    protected $view = 'Admin.Form.sku';



    protected static $css = [
        'http://mall.org/css/admin/form/attrname.css',
    ];
//
    protected static $js = [
        './js/admin/form/sku.js',
        './js/admin/form/labelauty.js',
    ];

    public function render()
    {
        $type = ProductType::get()->toArray();

        $path = request()->path();
        $product_id = explode('/',$path);
        parent::addVariables(['type'=>$type,'product_id'=>$product_id[2]]);
        return parent::render();
    }
}