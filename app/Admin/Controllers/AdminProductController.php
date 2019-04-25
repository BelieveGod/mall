<?php

namespace App\Admin\Controllers;

use App\Model\Product;
use App\Http\Controllers\Controller;
use App\Model\Store;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AdminProductController extends Controller
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
            ->header('所有商品')
            ->description('列表')
            ->breadcrumb(['text' => '所有商品'])
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->model()->where('is_show' , 1)->orderBy('created_at','desc');

        $grid->product_id('ID');
        $grid->store_id('商店名称')->using(Store::getStoreNameByStoreId());
        $grid->product_name('商品名称');
        $grid->product_num('库存');
        $grid->prime_cost('商品原价');
        $grid->present_price('商品现价');
        $grid->product_freght('运费');

        $grid->status('状态')->select(Product::productStatic());

        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');
        //去掉多余的按钮
        $grid->disableRowSelector();
        $grid->disableCreateButton();
        $grid->disableActions();
        //添加查询过滤
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('product_name', '商品名称');
            $filter->where(function ($query) {
                $query->whereIn('store_id', Store::where('store_name', 'like', "%{$this->input}%")->get(['store_id'])->toArray());
            }, '店铺名称');
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
        $show = new Show(Product::findOrFail($id));

        $show->product_id('Product id');
        $show->product_name('Product name');
        $show->product_num('Product num');
        $show->product_explain('Product explain');
        $show->type_id('Type id');
        $show->keyword('Keyword');
        $show->prime_cost('Prime cost');
        $show->present_price('Present price');
        $show->store_name('Store name');
        $show->store_id('Store id');
        $show->category_id('Category id');
        $show->category_name('Category name');
//        $show->product_master_img('Product master img');
        $show->status('Status');
//        $show->product_detail('Product detail');
        $show->product_freght('Product freght');
        $show->is_show('Is show');
        $show->auditing('Auditing');
        $show->deleted_at('Deleted at');
        $show->updated_at('Updated at');
        $show->created_at('Created at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->text('product_name', 'Product name');
        $form->number('product_num', 'Product num');
        $form->text('product_explain', 'Product explain');
        $form->number('type_id', 'Type id');
        $form->text('keyword', 'Keyword');
        $form->decimal('prime_cost', 'Prime cost');
        $form->decimal('present_price', 'Present price');
        $form->text('store_name', 'Store name');
        $form->number('store_id', 'Store id');
        $form->number('category_id', 'Category id');
        $form->text('category_name', 'Category name');
        $form->text('product_master_img', 'Product master img');
        $form->number('status', 'Status');
        $form->text('product_detail', 'Product detail');
        $form->decimal('product_freght', 'Product freght');
        $form->number('is_show', 'Is show');
        $form->number('auditing', 'Auditing');

        return $form;
    }
}
