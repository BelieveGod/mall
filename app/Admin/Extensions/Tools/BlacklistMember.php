<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class BlacklistMember extends BatchAction
{
    protected $action;

    public function __construct($action = 1)
    {
        $this->action = $action;
    }

    public function script()
    {
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {
    
    $.ajax({
        method: 'post',
        url: '{$this->resource}/blacklist',
        data: {
            _token:LA.token,
            ids: selectedRows(),
            action: {$this->action}
        },
        success: function (res) {
            console.log(res);
            $.pjax.reload('#pjax-container');
            toastr.success('操作成功');
        }
    });
});

EOT;

    }
}