<?php

namespace App\Admin\Controllers;

use App\Model\Product;
use App\Model\ProductForm;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductFormController extends Controller
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
            ->body($this->sendProduct()->edit($id));
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
        $grid = new Grid(new ProductForm);

//        $grid->form_id('ID');
        $grid->form_num('订单号');
        $grid->product_id('商品')->display(function ($id){
            return Product::findProductNameById($id);
        });

//        $grid->num('商品数量');
//        $grid->sku_id('商品规格');
//        $grid->form_freght('运费');
        $grid->form_cost('订单总价');
//        $grid->form_address_id('收货地址');
//        $grid->bussiness_address_id('发货地址');
        $grid->status('状态')->using(ProductForm::productFormSatus())->display(function ($text){
            return "<span class='label bg-green'>$text</span>";
        });
        $grid->pay_type('付款方式')->using(ProductForm::productFormPayType())->display(function($type){
            return "<span class='label label-warning'>$type</span>";
        });
//        $grid->pay_time('支付时间');
        $grid->created_at('订单创建时间');
        $grid->updated_at('修改时间');
//        $grid->deleted_at('Deleted at');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->append("<a href='/admin/productform/{$actions->getKey()}/edit'><span class='label bg-blue-active'>发货</span></a>");
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
        $show = new Show(ProductForm::findOrFail($id));

        $show->form_id('Form id');
        $show->product_id('Product id');
        $show->form_num('Form num');
        $show->num('Num');
        $show->sku_id('Sku id');
        $show->form_freght('Form freght');
        $show->form_cost('Form cost');
        $show->form_address_id('Form address id');
        $show->bussiness_address_id('Bussiness address id');
        $show->status('Status');
        $show->pay_time('Pay time');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->deleted_at('Deleted at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductForm);
        $form->text('form_num', '订单号');
        $form->text('product_id', '商品');
        $form->number('sku_id', '商品规格');
        $form->number('num', '商品件数');
        $form->currency('form_freght', '订单运费')->symbol('￥');
        $form->currency('product_cosr' , '商品总价')->symbol('￥');
        $form->currency('form_cost', '订单总价')->symbol('￥');
        $form->number('form_address_id', '收货地址');
        $form->number('bussiness_address_id', '发货地址');
        $form->number('status', '订单状态');
        $form->number('pay_time', '付款时间');
        //待处理数据
//        $form->text('store_id' , '店铺id');

        return $form;
    }

    protected function sendProduct()
    {
        $form = new Form(new ProductForm);

        $form->businessaddress('bussiness_address_id', '发货地址')->options();
        $form->text('post_id' , '快递单号');



        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
