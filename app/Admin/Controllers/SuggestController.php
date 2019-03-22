<?php

namespace App\Admin\Controllers;

use App\Model\Suggest;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class SuggestController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->row(function(Row $row) use($id) {
                $row->column(6, $this->detail($id));
                $row->column(6, $this->form()->edit($id));
            });
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Suggest);

        $grid->suggest_id('id');
        $grid->user_id('反馈用户')->using(User::findNameByUserId());
        $grid->suggest_type('反馈类型')->using(Suggest::suggestType());
        $grid->suggest_attr('反馈分类');
        $grid->created_at('创建时间');

        //按钮的设置
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->append('<a href="/admin/suggest/'.$actions->getKey().'/edit"><span class="label label-info">查看详情</span></a>');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Suggest::findOrFail($id));

        $show->suggest_id('id');
        $show->suggest_type('反馈类型')->using(Suggest::suggestType());
        $show->suggest_attr('反馈分类');
        $show->text('反馈内容');
        $show->user_id('用户名称')->using(User::findNameByUserId());
        $show->created_at('反馈时间');
//        $show->updated_at('Updated at');
//        $show->deleted_at('Deleted at');
        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableList();
            $tools->disableDelete();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Suggest);

        $admin_id = Admin::user()->id;
        $form->hidden('admin_id' )->default($admin_id);
        $form->textarea('reply', '回复');
        //去掉脚部多余的按钮
        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        //去掉多余的按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });


        return $form;
    }
}
