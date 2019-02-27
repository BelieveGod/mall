<?php

namespace App\Admin\Extensions\Form;

use App\Model\BusinessAddress;
use Encore\Admin\Form\Field;

class BusinessAddressBtn extends Field
{
    protected $view = 'Admin.Form.businessAddress';

    protected static $css = [
        './css/admin/form/attrname.css',
    ];


    public function render()
    {
        $store_id = 0;
        $address = BusinessAddress::where('store_id' , $store_id)->get()->toArray();
        parent::addVariables(['address'=>$address]);

        return parent::render();
    }
}