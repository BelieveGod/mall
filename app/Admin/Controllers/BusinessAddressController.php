<?php

namespace App\Admin\Controllers;

use App\Model\BusinessAddress;
use App\Http\Controllers\Controller;
use App\Model\Regions;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class BusinessAddressController extends Controller
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
            ->description('发货地址')
            ->breadcrumb(['text' => '发货地址'])
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
            ->description('地址信息')
            ->breadcrumb(['text' => '发货地址'])
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
            ->description('编辑地址信息')
            ->breadcrumb(['text' => '发货地址'])
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
            ->header('订单模块')
            ->description('发货地址')
            ->breadcrumb(['text' => '发货地址'])
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BusinessAddress);

        $store_id = Auth::guard('admin')->user()->id;
        $grid->model()->where('store_id' , $store_id);

        $grid->business_address_id('ID');
        $grid->county('所属地区')->display(function ($id) {
            return Regions::findAddress($id);
        });
        $grid->business_name('发货人');
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
        ];
        $grid->status('默认地址')->switch($states);

        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->disableExport();
        //去掉行间按钮
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->append('<a href="/admin/business_address/'.$actions->getKey().'/edit"><span class="label label-info">修改</span></a>');
            $actions->append('<a href="/admin/business_address/'.$actions->getKey().'"><span class="label bg-light-blue">查看详情</span></a>');
        });



        //待处理数据
//        $grid->store_id('Store id');
//        $grid->deleted_at('Deleted at');
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
        $show = new Show(BusinessAddress::findOrFail($id));

        $show->business_address_id('ID');
        $show->business_name('发货人');
//        $show->province('Province');
//        $show->city('City');
        $show->county('所属地区')->as(function ($id) {
            return Regions::findAddress($id);
        });
        $show->address('详细地址');
        $show->tell('联系电话');

//        $show->store_id('Store id');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');
//        $show->deleted_at('Deleted at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BusinessAddress);

        $form->text('business_name', '发货人')->rules('required',['发货人不能为空']);
        $form->select('province', '省')->options(Regions::province())->load('city', '/admin/api/getregion');
        $form->select('city', '市')->options(function ($city) {
            if($city){
                return Regions::areaoptions($city);
;            }
        })->load('county', '/admin/api/getregion');
        $form->select('county', '县/区')->options(function ($county) {
            if($county) {
                return Regions::areaoptions($county);
            }
        });
        $form->text('address', '详细地址')->rules('required',['详细地址不能为空']);
        $form->mobile('tell' , '联系电话')->options(['mask' => '99999999999'])->rules('required',['联系电话不能为空']);
//        $form->text('tell' , '联系电话');
        $form->gaodemap('gps' , '地图');
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];

        $form->switch('status', '设为默认地址')->states($states);
        $store_id = Auth::guard('admin')->user()->id;
        $form->hidden('store_id', '店铺id')->default($store_id);

        //去掉脚部按钮
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        //删除右上角的按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
