<?php

namespace App\Admin\Controllers;

use App\Model\Category;
use App\Model\ProductAttr;
use App\Model\ProductAttrValue;
use App\Model\ProductType;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
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
            ->header('商品类型')
            ->description('description')
            ->body($this->form());
    }

//    public function addattrvalue($id,Content $content)
//    {
//        return $content
//            ->header('商品属性值')
//            ->description('description')
//            ->body($this->attrvaluebtn()->edit($id));
//    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductType);

        $grid->type_id('类型id');
        $grid->type_name('类型名称');
        $grid->category_id('所属分类');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

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
        $show = new Show(ProductType::findOrFail($id));

        $show->type_id('Type id');
        $show->type_name('Type name');
        $show->category_id('Category id');
        $show->category_name('Category name');
        $show->sort_order('Sort order');
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
        $form = new Form(new ProductType);

        $form->text('type_name', '类型名称');
        $form->select('category_id' , '选择分类')->options(Category::parentsId());
        $form->text('sort_order', '排序');

        $form->hasMany('productAttr','商品规格属性', function (Form\NestedForm $form) {
            $form->text('attr_name','商品规格');
            $form->attrvaluebtn('attrvaluebtn','规格属性');

        });

        $form->ignore(['attrvaluebtn']);

        //保存后回调
        $form->saved(function (Form $form){
            //获得分类名称
            $category_id = $form->category_id;
            $category_name = Category::where('category_id',$category_id)->value('category_name');
            ProductType::where('type_id',$form->model()->type_id)->update(['category_name' => $category_name]);

            $attrvalue = request('attrValue');
            $attr = ProductAttr::where('type_id',$form->model()->type_id)->get()->toArray();

//            var_dump($attr);
//            var_dump($attrvalue);
//            dd(2);
            $num = count($attr);

            for($i = 0 ; $i<$num ; $i++){
                $j = $i+1;
                $new = 'new_'.$j;
                foreach ($attrvalue[$new] as $val){
                        $productattrvalue = ProductAttrValue::updateOrCreate([
                            'attr_id' => $attr[$i]['attr_id'],
                            'type_id' => $form->model()->type_id,
                        ],[
                            'attr_value_name' => $val,
                    ]);

                    $productattrvalue->save();
                }
            }
        });


        //去掉右下角的选择
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();

        });

        return $form;
    }

//    protected function attrvaluebtn()
//    {
//        $form = new Form(new ProductType());
//
//        $form->text('type_name', '类型名称');
//
//        $form->attrvaluebtn('attrvaluebtn','规格属性');
//
//        return $form;
//    }

}
