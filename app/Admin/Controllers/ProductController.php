<?php

namespace App\Admin\Controllers;

use App\Model\Category;
use App\Model\Product;
use App\Http\Controllers\Controller;
use App\Model\ProductAttr;
use App\Model\ProductAttrValue;
use App\Model\ProductSku;
use App\Model\ProductType;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
        $grid = new Grid(new Product);

        $store_id = Auth::guard('admin')->user()->id;

        $grid->model()->where('store_id',$store_id);

        $grid->product_id('ID');
        $grid->product_name('商品名称');
        $grid->product_num('库存');
//        $grid->product_explain('商品说明');
//        $grid->type_id('商品类型');
//        $grid->keyword('搜索关键词');
        $grid->prime_cost('商品原价');
        $grid->present_price('商品现价');
//        $grid->store_id('商店ID');
//        $grid->store_name('商店名称');
//        $grid->category_id('分类id');
//        $grid->category_name('分类名称');
//        $grid->product_master_img('商品主图');
//        $grid->product_detail('商品详情');
        $grid->product_freght('运费');
//        $grid->auditing('审核');
        $isshhow = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
        ];
        $grid->is_show('是否显示')->switch($isshhow);
        $grid->status('状态')->select([
            1 => '热门',
            2 => '最新',
            3 => '推荐',
        ]);

        $grid->updated_at('更新时间');
        $grid->created_at('创建时间');

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
        $show->store_id('Store id');
        $show->category_id('Category id');
        $show->category_name('Category name');
        $show->product_master_img('Product master img');
        $show->status('Status');
        $show->product_detail('Product detail');
        $show->product_freght('Product freght');
        $show->auditing('Auditing');
        $show->deleted_at('Deleted at');
        $show->updated_at('Updated at');

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

//        $form->tab('基本信息', function ($form) {
            $form->select('category_id' , '选择分类')->options(Category::parentsId());
            $form->text('product_name', '商品名称');
            $form->number('product_num', '商品库存');
            $form->text('product_explain', '商品说明');
            $form->text('keyword', '搜索关键词');
            $form->currency('prime_cost', '商品原价')->symbol('￥');
            $form->currency('present_price', '商品现价')->symbol('￥');
            $form->currency('product_freght', '运费')->symbol('￥');
            $form->ueditor('product_detail', '商品详情');

            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('is_show','是否显示')->states($states);
            $form->select('status','状态')->options([
                1 => '热门',
                2 => '最新',
                3 => '推荐',
            ]);
            $store_id = Auth::guard('admin')->user()->id;
//            dd($store_id);
            $form->hidden('store_id', '商店id')->default($store_id);
            $form->hidden('store_name', '商店名称')->default('0');
            $form->hidden('auditing', '审核')->default('1');

//        })->tab('商品主图', function ($form) {
            $form->multipleImage('product_master_img', '商品主图')->removable();

//        })->tab('价格及库存',function ($form){
//            $form->select('type_id', '商品类型');
            $form->sku('type_id','商品类型');
//        });

        //保存前回调
        $form->saved(function (Form $form) {
            //获得分类名称和分类id
            $category_id = $form->category_id;
            $product_id = $form->model()->product_id;
            $category_name = Category::where('category_id',$category_id)->value('category_name');
            $type_id = \request('type_id');
            Product::where('product_id',$product_id)
                ->update(['category_name' => $category_name , 'type_id' => $type_id]);

            $attr = ProductAttr::where('type_id' , $type_id)->get()->toArray();
            $sku_attr = '';
            foreach ($attr as $value){
                $sku_attr .= $value['attr_id'].'_';
            }
            $sku_attr = substr($sku_attr,0,-1);

            $sku = \request('sku');
            $kucun = \request('kucun');
            $price = \request('price');
            $num = count($sku);
            $temp = [];


            for($i = 0 ; $i<$num ; $i++){
//                $data = [
//                    'product_id' => $product_id,
//                    'price' => $price[$i],
//                    'num' => $kucun[$i],
//                    'sku_attr' => $sku_attr,
//                    'sku_val' => $sku[$i],
//                ];
               $productsku = ProductSku::updateOrCreate([
                   'product_id' => $product_id,
                   'sku_attr' => $sku_attr,
                   'sku_val' => $sku[$i],
                   ],[
                   'price' => $price[$i],
                    'num' => $kucun[$i],
               ]);
                $productsku->save();
            }

//            ProductSku::insert($temp);
//            var_dump($temp);
//            var_dump($kucun);
//            var_dump($sku);
//            var_dump($sku_attr);
//            dd();

        });


        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }

    public function showAttr(Request $request)
    {
        $type_id = $request->get('type_id');
        $attr = ProductAttr::where('type_id',$type_id)->get();

        $list= [];
        $temp = [];
        foreach ($attr as $value){
            $temp['attr_name'] = $value->attr_name;
            $attr_id = $value->attr_id;
            $attr_value = ProductAttrValue::where('attr_id',$attr_id)->get();
            $tmp = [];
            $tmplist = [];
            foreach ($attr_value as $val){
                $tmp['attr_value_id'] = $val->attr_value_id;
                $tmp['attr_value_name'] = $val->attr_value_name;
                $tmplist[] = $tmp;
                $temp['attr_value'] = $tmplist;
            }
            $list[] = $temp;
        }

        if(isset($request->product_id)){
            $product_id = $request->product_id;
            $res = ProductSku::where('product_id' , $product_id)->get()->toArray();
            $attr = $res[0]['sku_attr'];
            $attr = explode('_' , $attr);

            $attr_name = [];
            foreach ($attr as $val){
                $temp = ProductAttr::where('attr_id' , $val)->value('attr_name');
                $attr_name[] = $temp;
            }
            $attr_name[] = '库存';
            $attr_name[] = '价格';

            $data = [];
            foreach ($res as $val){


                $sku_val = $val['sku_val'];
                $sku_val = explode('_' , $sku_val);
                $tmp = [];
                foreach ($sku_val as $value){
                    $t = ProductAttrValue::where('attr_value_id' , $value)->value('attr_value_name');
                    $tmp[] = $t;
                }
                $tmp['num'] = $val['num'];
                $tmp['price'] = $val['price'];
                $tmp['sku_val'] = $val['sku_val'];
                $tmp['count'] = count($sku_val);
                $data[] = $tmp;
            }

//            var_dump($data);
//            var_dump($data);
//            dd();
            return view('admin.form.attrlist',
                ['attr'=>$list,'attrname'=>$attr_name,'abs'=>'am-btn-success','ao'=>'attr-on','data'=>$data]);
        }else{
            return view('admin.form.attrlist',['attr'=>$list]);
        }

    }

}
