<?php

namespace App\Admin\Controllers;

use App\Model\Advertisement;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AdvertisementController extends Controller
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
        $grid = new Grid(new Advertisement);

        $grid->ad_id('Ad id');
        $grid->ad_img('Ad img');
        $grid->is_show('Is show');
        $grid->used('Used');
        $grid->dec('Dec');
        $grid->title('Title');
        $grid->old_price('Old price');
        $grid->now_price('Now price');
        $grid->sort('Sort');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->deleted_at('Deleted at');

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
        $show = new Show(Advertisement::findOrFail($id));

        $show->ad_id('Ad id');
        $show->ad_img('Ad img');
        $show->is_show('Is show');
        $show->used('Used');
        $show->dec('Dec');
        $show->title('Title');
        $show->old_price('Old price');
        $show->now_price('Now price');
        $show->sort('Sort');
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
        $form = new Form(new Advertisement);

        $form->uploadImg('ad_img', '上传图片');
        $form->text('dec', '图片描述');
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $form->switch('is_show', '是否显示')->states($states);
        $form->text('sort', '排序')->help('数字越大排序越后');
        $form->select('used', '显示的位置')->options(Advertisement::advertisementUsed());
        $form->select('product_id' , '对应商品')->options(Product::findProductNameById());
        //去掉脚部多余的按钮
        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        //保存前回调
        $form->savd(function(Form $form) {
            $up = \request('up');
            $ad_img = json_decode();
            $ad = Advertisement::find($form->model()->ad_id);
//            $ad->ad_img =
        });

        return $form;
    }
}
