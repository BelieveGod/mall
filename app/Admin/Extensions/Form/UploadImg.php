<?php

namespace App\Admin\Extensions\Form;

use App\Model\ProductType;
use Encore\Admin\Form\Field;
use Illuminate\Http\Request;

class UploadImg extends Field
{
    protected $view = 'Admin.Form.uploadImg';

//    protected static $js = [
//        './js/admin/form/uploadImg.js',
//    ];



    public function render()
    {
        $this->script = <<<EOT

EOT;
        return parent::render();
    }
}