<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class UEditor extends Field
{
    protected $view = 'Admin.Form.UEditor';


    protected static $js = [
        '/vendor/UEditor/ueditor.config.js',
        '/vendor/UEditor/ueditor.all.min.js',
        '/vendor/UEditor/lang/zh-cn/zh-cn.js',

    ];
//
    public function render()
    {
$this->script = <<<EOT
        UE.delEditor('{$this->id}');
        var  ue = UE.getEditor('{$this->id}');
EOT;
        return parent::render();
    }
}