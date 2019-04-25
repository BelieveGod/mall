<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\BlacklistStore;
use App\Model\Regions;
use App\Model\Store;
use App\Http\Controllers\Controller;
use App\Model\StoreLog;
use App\Services\Common\ShowPicService;
use App\Services\Common\ShowPicServices;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
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
            ->body($this->detail($id))
            ->row($this->storeLog($id));
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
        return $content->row(function(Row $row) use($id) {
            $row->column(6, $this->detail($id));
            $row->column(6,function (Column $column) use ($id){
                $column->row($this->updatestore()->edit($id));
                $column->row($this->storeLog($id));
            });
        });
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
        $grid = new Grid(new Store);

        $grid->model()->where('blacklist','!=','1');
        $grid->disableExport();

        $grid->store_id('ID');
        $grid->business_name('商家实名');
        $grid->store_name('店铺名称');
        $grid->business_tel('商家电话');
        $grid->status('状态')->display(function ($status){
            $storeStatus = Store::StoreStatus();
            switch ($status) {
                case Store::PENDING_APPLICATION:
                    return "<span class='label label-warning'>$storeStatus[$status]</span>";
                    break;
                case Store::APPLICATION_PASSED:
                    return "<span class='label label-success'>$storeStatus[$status]</span>";
                    break;
                case Store::APPLICATION_FAILED:
                    return "<span class='label label-danger'>$storeStatus[$status]</span>";
                default :
                    return $status;
            }
        });
        $grid->created_at('创建时间');
        $grid->updated_at('修改时间');
//        $grid->deleted_at('Deleted at');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            if($actions->row['status'] == Store::PENDING_APPLICATION){
                $actions->append('<a href="/admin/store/'.$actions->getKey().'/edit"><span class="label label-info">审核</span></a>');
            }else{
                $actions->append('<a href="/admin/store/'.$actions->getKey().'"><span class="label label-warning">查看</span></a>');
            }

        });

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('store_name', '店铺名字');
            $filter->like('business_name', '商家实名');
        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->add('关进小黑屋', new BlacklistStore(1));
            });
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function  detail($id)
    {
        $show = new Show(Store::findOrFail($id));

        $show->store_id('商店id');
        $show->store_name('商店名');
        $show->business_nickname('商家昵称');
        $show->divider();
        $show->business_name('注册实名');
        $show->business_tel('注册电话');
//        $show->regions_id('所属地区')->as(function ($value){
//            return Regions::findArea($value);
//        });
        $show->identity_card('身份证号');
        $show->address('注册地址');
        $show->post_num('邮政编码');
        $show->business_pic('核实照片')->unescape()->as(function ($pic){
            return ShowPicService::getlineimgs($pic);
        });
        $show->created_at('创建时间');
        $show->updated_at('更新时间');
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
    protected function updatestore()
    {
        $form = new Form(new Store);

        $form->select('status' , '审核')->options(Store::StoreStatus());
        $form->textarea('memo' , '备注');
        $form->footer(function ($footer) {
            $footer->disableCreatingCheck();
            $footer->disableEditingCheck();
            $footer->disableViewCheck();
            $footer->disableReset();
        });
        $form->tools(function ($tools) {
            $tools->disableDelete();
//            $tools->disableList();
            $tools->disableView();
        });

        $form->saved(function (Form $form){
//            $store_log = new StoreLog;
//            $store_log->store_form_id = $form->model()->store_id;
//            $store_log->action_status = $form->model()->status;
//            $store_log->memo = $form->model()->memo;
//            $store_log->save();
        });


        return $form;
    }

    protected function storeLog($id)
    {
        $grid = new Grid(new StoreLog);
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disablePagination();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableActions();

        $grid->model()->where('store_form_id',$id );

        $grid->id('ID');
        $grid->action_status('状态')->display(function ($status){
            $storeStatus = Store::StoreStatus();
            switch ($status) {
                case Store::PENDING_APPLICATION:
                    return "<span class='label label-warning'>$storeStatus[$status]</span>";
                    break;
                case Store::APPLICATION_PASSED:
                    return "<span class='label label-success'>$storeStatus[$status]</span>";
                    break;
                case Store::APPLICATION_FAILED:
                    return "<span class='label label-danger'>$storeStatus[$status]</span>";
                default :
                    return $status;
            }
        });
        $grid->memo('备注');
        $grid->created_at('操作时间');

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Store);

        $form->footer(function ($footer) {
            $footer->disableCreatingCheck();
            $footer->disableEditingCheck();
            $footer->disableViewCheck();
//            $footer->disableReset();
        });
        $form->tools(function ($tools) {
            $tools->disableDelete();
//            $tools->disableList();
            $tools->disableView();
        });

        $form->text('business_nickname' , '商家昵称');
        $form->text('store_name' ,'店铺名称');
        $form->divide();
        $form->text('business_name' , '注册实名');
        $form->mobile('business_tel' ,'注册电话')->options(['mask' => '999 9999 9999']);
        $form->text('identity_card' , '身份证号');
        $form->text('address' , '注册地址');
        $form->text('post_num' ,'邮政编码');
        $form->image('business_pic' , '实名拍照核实照片');
        $form->hidden('memo' , '备注')->default('管理后台添加');
        $form->hidden('status' , '状态')->default(2);
        $form->hidden('blacklist' , '是否是黑名单')->default(0);


        $form->saved( function (Form $form){
            if($form->model()->status == Store::APPLICATION_PASSED){
                //创建后台用户
                $data = [
                    'username' => $form->model()->business_tel,
                    'password' => bcrypt(123456),
                    'name' => $form->model()->store_name,
                    'created_at' => date('Y-m-d H:i:s' , time()),
                    'updated_at' => date('Y-m-d H:i:s' , time()),
                ];
                $user = DB::table('admin_users')->insertGetId($data);
                //赋予供应商权限
                DB::table('admin_role_users')->insert(['user_id' => $user , 'role_id' => 2]);


                $store = Store::find($form->model()->store_id);
                $store->admin_id = $user;
                $store->save();
            }

            $store_log = new StoreLog;
            $store_log->store_form_id = $form->model()->store_id;
            $store_log->action_status = $form->model()->status;
            $store_log->memo = $form->model()->memo;
            $store_log->save();
        });

        return $form;
    }

    public function putblacklist(Request $request)
    {
        $arr = $request->post('ids');
        foreach (Store::find($arr) as $blacklist) {
            $blacklist->blacklist = 1;
            $blacklist->save();
        }
    }

    //商家小黑屋
    public function blackliststorelist()
    {
//        return $content
//            ->header('Index')
//            ->description('description')
//            ->body($this->grid());
        return 123;
    }

}
