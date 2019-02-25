<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class AttrValueBtn extends Field
{
    protected $view = 'Admin.Form.attrvaluebtn';

//    protected static $css = [
//        '/vendor/wangEditor-3.0.9/release/wangEditor.min.css',
//    ];
//
    protected static $js = [
        './js/admin/form/attrvaluebtn.js',
    ];
//
//    public function render()
//    {
//        $this->script = <<<EOT
//
//
//
//
//
//
//EOT;
//        return parent::render();
//    }
}