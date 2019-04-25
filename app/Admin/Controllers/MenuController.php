<?php

namespace App\Admin\Controllers;

use App\Model\Menu;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MenuController extends Controller
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
            ->header('网站管理')
            ->description('菜单栏管理')
            ->breadcrumb(['text' => '菜单栏管理'])
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
            ->header('菜单栏管理')
            ->description('编辑')
            ->breadcrumb(['text' => '菜单栏管理'])
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('菜单栏管理')
            ->description('创建')
            ->breadcrumb(['text' => '菜单栏管理'])
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Menu);

        $grid->menu_id('id');
        $grid->img('图标')->display(function ($img) {
            return '<i class="fa '.$img.'"></i>';
        });
        $grid->menu_name('名称')->editable('text');
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->sort('排序')->editable('text');
        $grid->is_show('是否显示')->switch($states);
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->disableExport();
        //查询过滤
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('menu_name', '名称');
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Menu);

        $form->text('menu_name', '名称');
        $form->icon('img', '图标')->help("更多图标请打开 <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>");
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $form->switch('is_show', '是否显示')->states($states);
        $form->text('sort' , '排序')->help('数字越大排序越后');
        $form->textarea('decs', '描述');

        //去掉脚部多余的按钮
        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
