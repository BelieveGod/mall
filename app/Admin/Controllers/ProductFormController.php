<?php

namespace App\Admin\Controllers;

use App\Model\BusinessAddress;
use App\Model\Product;
use App\Model\ProductForm;
use App\Http\Controllers\Controller;
use App\Model\ProductSku;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

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
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
//    public function create(Content $content)
//    {
//        return $content
//            ->header('Create')
//            ->description('description')
//            ->body($this->addForm());
//    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductForm);
        $store_id = Auth::guard('admin')->user()->id;
        $grid->model()->where('store_id' , $store_id);
//        $grid->form_id('ID');
        $grid->model()->orderBy('status');
        $grid->form_num('订单号');
        $grid->product_id('商品')->using(Product::findProductNameById());

        $grid->form_cost('订单总价');
        $grid->status('状态')->using(ProductForm::productFormSatus())->display(function ($text){
            return "<span class='label bg-green'>$text</span>";
        });
        $grid->pay_type('付款方式')->using(ProductForm::productFormPayType())->display(function($type){
            return "<span class='label label-warning'>$type</span>";
        });
        $grid->created_at('订单创建时间');
        $grid->updated_at('修改时间');

        $grid->form_id('订单详情')->display(function ($id) {
            return '<a href="/admin/productform/'.$id.'"><span class="label label-default">查看</span></a>';
        });
        //修改行间样式
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();

            if($actions->row['status'] == ProductForm::PLACE_ORDER || $actions->row['status'] == ProductForm::WAIT_DELIVER_GOODS){
                $actions->append("<a href='/admin/productform/{$actions->getKey()}/edit'><span class='label label-danger'>发货</span></a>");
            }else if($actions->row['status'] == ProductForm::DELIVER_GOODS) {
                $actions->append("<a href='/admin/productform/{$actions->getKey()}'><span class='label bg-blue'>查看物流</span></a>");
            }
        });
        //去掉右上角的按钮
        $grid->disableCreateButton();
        $grid->disableExport();

        //添加过滤器
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('form_num', '订单号');
            $filter->between('created' , '订单创建时间')->datetime();
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

        $show->form_id('ID');
        $show->form_num('订单号');
        $show->product_id('商品')->using(Product::findProductNameById());
        $show->sku_id('商品规格')->as(function ($val) {
            return ProductSku::findskuvaluebyskuid($val);
        });
        $show->num('商品件数');
        $show->divider();
        $show->product_cost('商品总价');
        $show->form_freght('订单运费');
        $show->form_cost('订单总价');
        $show->divider();
        $show->form_address_id('收货地址');
        $show->bussiness_address_id('发货地址')->using(BusinessAddress::findaddressbyid());
        $show->status('状态')->using(ProductForm::productFormSatus())->unescape()->as(function ($val){
            return "<span class='label bg-green'>$val</span>";
        });
        $show->pay_type('付款方式')->using(ProductForm::productFormPayType())->unescape()->as(function ($val) {
            return "<span class='label label-warning'>$val</span>";
        });
        $show->post_num('快递单号');
        $show->pay_time('付款时间');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        //按钮设置
        $show->panel()->tools(function ($tools) use($id) {
            $tools->disableEdit();
//            $tools->disableList();
            $tools->disableDelete();
            $tools->append("<a href='/admin/productform/".$id."/edit' style='margin-right:5px'><span class='btn btn-sm btn-danger'>发货</span></a>");
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
//    protected function addForm()
//    {
//        $form = new Form(new ProductForm);
//        $form->text('form_num', '订单号');
//        $form->text('product_id', '商品');
//        $form->number('sku_id', '商品规格');
//        $form->number('num', '商品件数');
//        $form->currency('form_freght', '订单运费')->symbol('￥');
//        $form->currency('product_cosr' , '商品总价')->symbol('￥');
//        $form->currency('form_cost', '订单总价')->symbol('￥');
//        $form->number('form_address_id', '收货地址');
//        $form->number('bussiness_address_id', '发货地址');
//        $form->number('status', '订单状态');
//        $form->number('pay_time', '付款时间');
//        //待处理数据
////        $form->text('store_id' , '店铺id');
//
//        return $form;
//    }

    protected function form()
    {
        $form = new Form(new ProductForm);
        $form->businessaddress('bussiness_address_id', '发货地址');
        $form->text('post_num' , '快递单号');
        //保存后回调
        $form->saved(function (Form $form) {
            $id = $form->model()->form_id;
            $post_num = request('post_num');
            if($post_num){
                ProductForm::where('form_id' , $id)->update(['status' => ProductForm::DELIVER_GOODS]);
            }


        });
        //去掉脚部按钮
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        //去掉右上角的按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        return $form;
    }
}
