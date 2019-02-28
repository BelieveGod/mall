<?php

namespace App\Admin\Extensions\Grid;

use Encore\Admin\Admin;

class AboutComment
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function script()
    {
        return <<<SCRIPT
$('.grid-check-row').on('click', function () {
    console.log($(this).data('id'));
    var id = $(this).data('id');
    var data = {};
    data.id = id;
    $.get('/admin/api/showaboutcomment/',data,function(ret){
        $('.col-md-4').children().remove();
        $('.col-md-4').append(ret);
    });
});

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        return "<span class='label label-info grid-check-row' style='cursor:pointer' data-id='{$this->id}'>具体评论</span>";
    }

    public function __toString()
    {
        return $this->render();
    }
}