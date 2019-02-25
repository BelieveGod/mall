<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class BusinessAddress extends Field
{
    protected $view = 'Admin.Form.businessAddress';

    protected static $css = [
        './css/admin/form/attrname.css',
    ];


    public function render()
    {
        $this->script = <<<EOT
EOT;
        return parent::render();
    }
}