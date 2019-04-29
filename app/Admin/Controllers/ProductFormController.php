<?php

namespace App\Admin\Controllers;

use App\Model\BusinessAddress;
use App\Model\Product;
use App\Model\ProductForm;
use App\Http\Controllers\Controller;
use App\Model\ProductSku;
use App\Model\Regions;
use App\Model\UserAddress;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
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
            ->header('订单模块')
            ->description('订单管理')
            ->breadcrumb(['text' => '订单管理'])
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
            ->header('订单模块')
            ->description('订单详情')
            ->breadcrumb(['text' => '订单管理'])
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
            ->header('订单模块')
            ->description('发货')
            ->breadcrumb(['text' => '订单管理'])
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
//        $grid->product_id('商品')->using(Product::findProductNameById());
        $grid->product_id('商品')->display(function ($product_arr){
            return $product_arr[0];
        })->using(Product::findProductNameById());

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
                $actions->append("<a href='/admin/find_logistics/{$actions->getKey()}'><span class='label bg-blue'>查看物流</span></a>");
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

        //判断状态
        $status = ProductForm::where('form_id' , $id)->value('status');

        $show->form_id('ID');
        $show->form_num('订单号');
//        $show->product_id('商品')->using(Product::findProductNameById());
//        $show->sku_id('商品规格')->as(function ($val) {
//            return ProductSku::findskuvaluebyskuid($val);
//        });
//        $show->num('商品件数');
        $show->product_id('商品')->unescape()->as(function () use($id){
            $str = '';
            $pro_form = ProductForm::find($id);
            $pro_arr = $pro_form->product_id;
            $pro_num = $pro_form->num;
            $pro = array_combine($pro_arr,$pro_num);

            foreach ($pro as $k=>$v){
                $p = Product::find($k);
                $str .= '<p><span>'.$p->product_name.'</span>-------------<label class="label-danger">'.$v.$p->unit.'</label></p>';
            }
            return $str;
        });

        $show->divider();
        $show->product_cost('商品总价');
        $show->form_freght('订单运费');
        $show->form_cost('订单总价');
        $show->divider();
        $show->user_id('购买用户')->using(User::findNameByUserId());
        $show->column('收货人')->as(function () use($id){
            $user_address_id = ProductForm::find($id)->form_address_id;
            $user_address = UserAddress::findOnceUserAddUseInPluck($user_address_id);
            return $user_address->name;
        });
        $show->column('收货人联系方式')->as(function () use($id){
            $user_address_id = ProductForm::find($id)->form_address_id;
            $user_address = UserAddress::findOnceUserAddUseInPluck($user_address_id);
            return $user_address->tell;
        });
        $show->form_address_id('收货地址')->as(function ($val){
            $user_address = UserAddress::findOnceUserAddUseInPluck($val);
            $zheng = Regions::finNameById($user_address->region);
            return $zheng.'&nbsp;&nbsp;'.$user_address->address;
        });
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
        $show->panel()->tools(function ($tools) use($id,$status) {
            $tools->disableEdit();
//            $tools->disableList();
            $tools->disableDelete();
            if($status == ProductForm::PAY_ON_LINE){
                $tools->append("<a href='/admin/productform/".$id."/edit' style='margin-right:5px'><span class='btn btn-sm btn-danger'>发货</span></a>");
            }

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

    /**
     * 发货
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductForm);
        $form->businessaddress('bussiness_address_id', '发货地址');
        $form->select('logistics_company' , '物流公司')->options(ProductForm::LogisticsCompany());
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

    /**
     * 查看物流信息
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function findLogistics($id, Content $content)
    {
        return $content
            ->header('订单模块')
            ->description('物流详情')
            ->breadcrumb(['text' => '订单管理'])
//            ->body($this->findLogisticsDetail($id));
            ->row(function(Row $row) use($id) {
                $row->column(6, $this->detail($id));
                $row->column(6, $this->findLogisticsDetail($id));
            });
    }

    protected function findLogisticsDetail($id)
    {
        $form = ProductForm::where('form_id' , $id)->first();

        $url='http://www.kuaidi100.com/query?type='.$form->logistics_company.'&postid='.$form->post_num;
        $html = file_get_contents($url);
        $data = json_decode($html,true);

        return view('Admin.findLogisticsDetail',['data' => $data]);
    }
}
