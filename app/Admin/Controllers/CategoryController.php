<?php

namespace App\Admin\Controllers;

use App\Model\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;

class CategoryController extends Controller
{
    use ModelForm;

    /**
     * 商品分类列表  和  创建商品分类
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        $content->header('商品分类');
        $content->description('列表');

        $content->row(function(Row $row) {
            $row->column(6, Category::tree(function ($tree){
                $tree->branch(function ($branch ) {
                    $img = '<i class="fa fa-bars"></i>';
                    return "$img {$branch['category_name']} ";
                });
            }));
            $row->column(6, function(Column $column){
                $form = new \Encore\Admin\Widgets\Form();
                $form->action(admin_base_path('categroy'));
                $form->text('category_name', '分类名称');
                $form->select('pid', '父级分类')->options(Category::parentsId());
                $form->text('sort_order', '排序');
                $states = [
                    'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
                ];
                $form->switch('is_show', '是否显示')->states($states);
                $form->textarea('category_dec', '分类说明');
                $form->text('keyword', '搜索关键字')->help('每个关键词用‘/’分隔');

                $form->hidden('_token')->default(csrf_token());
                $column->append((new Box(trans('admin.new'), $form))->style('success'));
            });
        });

        return $content;

    }

    /**
     * 修改商品分类
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
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

        $grid->category_id('分类id');
        $grid->category_name('分类名称');
//        $grid->is_show('是否显示');
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->is_show()->switch($states);

        $grid->created_at('创建时间');
        $grid->updated_at('修改时间');

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category);

        $form->text('category_name', '分类名称');
//        $form->number('pid', '父级分类');
        $form->select('pid', '父级分类')->options(Category::parentsId());
        $form->text('sort_order', '排序');
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $form->switch('is_show', '是否显示')->states($states);
        $form->textarea('category_dec', '分类说明');
        $form->text('keyword', '搜索关键字')->help('每个关键词用‘/’分隔');

        //去掉右下角的选择
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }

}
