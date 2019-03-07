<?php

namespace App\Admin\Extensions\Form;

use App\Model\ProductType;
use Encore\Admin\Form\Field;
use Illuminate\Http\Request;

class UploadImg extends Field
{
    protected $view = 'Admin.Form.uploadImg';

    protected static $css = [

    ];
//
    protected static $js = [

    ];

//    public function render()
//    {
//        $type = ProductType::get()->toArray();
//
//        $path = request()->path();
//        $product_id = explode('/',$path);
//        parent::addVariables(['type'=>$type,'product_id'=>$product_id[2]]);
//        return parent::render();
//    }
}