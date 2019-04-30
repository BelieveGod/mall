<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Grid\AboutComment;
use App\Model\Member;
use App\Model\Product;
use App\Model\ProductComment;
use App\Http\Controllers\Controller;
use App\Model\ProductForm;
use App\Model\ProductSku;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductCommentController extends Controller
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
            ->header('商品管理')
            ->description('评论统计')
            ->breadcrumb(['text' => '评论统计'])
            ->body($this->commentbyproductid());
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
            ->header('商品管理')
            ->description('评论列表')
            ->breadcrumb(['text' => '评论列表'])
            ->row(function(Row $row) use($id) {
                $row->column(8, $this->grid($id));
                $row->column(4, '');
            });
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    protected function grid($id)
    {
        $grid = new Grid(new ProductComment);

        $grid->model()->where('product_id' , $id);

        $grid->product_comment_id('id');
        $grid->product_form_id('订单号')->using(ProductForm::findPostIdByProductFormId());
        $grid->product_id('商品')->using(Product::findProductNameById());
//        $grid->sku_id('属性规格')->display(function ($val){
//            return ProductSku::findskuvaluebyskuid($val);
//        });

        $grid->haoping('评价')->display(function ($val){
            $feel = ProductComment::productCommentHaoping();
            switch ($val) {
                case ProductComment::ZHONGPING:
                    return "<span class='label label-warning'>$feel[$val]</span>";
                    break;
                case ProductComment::HAOPING:
                    return "<span class='label label-success'>$feel[$val]</span>";
                    break;
                case ProductComment::CHAPING:
                    return "<span class='label label-danger'>$feel[$val]</span>";
                default :
                    return $val;
            }
        });
        $grid->menber_id('用户')->using(Member::findMemberNameById());
//        $grid->comment('评论内容');


//        $grid->comment_pic('Comment pic');
//        $grid->store_id('Store id');
//        $states = [
//            'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
//            'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
//        ];
//        $grid->is_show('是否显示')->switch($states);
        $grid->created_at('评论时间');
//        $grid->updated_at('Updated at');
//        $grid->deleted_at('Deleted at');

        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableRowSelector();
//        $grid->disableActions();
        //查询过滤数据
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->in('haoping', '评价')->multipleSelect(ProductComment::productCommentHaoping());
        });
        //操作按钮
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->append(new AboutComment($actions->row['product_comment_id']));
//            $actions->append('<a href=""><span class="label label-info">具体评论</span></a>');
        });

        return $grid;
    }

    protected function commentbyproductid()
    {
        $grid = new Grid(new ProductComment);
        $store_id = Auth::guard('admin')->user()->id;
        //SELECT product_id , count(*) as num  FROM mall_product_comment GROUP BY product_id
        $grid->model()->select(['product_id',DB::raw('count(*)as num')])->where('store_id' , $store_id)->groupBy('product_id');

        $grid->product_id('商品')->using(Product::findProductNameById());
        $grid->column('好评数量')->display(function () {
            return ProductComment::counthaoping($this->product_id ,ProductComment::HAOPING);
        });
        $grid->column('中评数量')->display(function () {
            return ProductComment::counthaoping($this->product_id ,ProductComment::ZHONGPING);
        });
        $grid->column('差评数量')->display(function () {
            return ProductComment::counthaoping($this->product_id ,ProductComment::CHAPING);
        });
        $grid->num('评论总数');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->append('<a href="/admin/product_comment/'.$actions->row['product_id'].'"><span class="label label-info">查看评论</span></a>');
        });
        $grid->disableCreateButton();
        $grid->disableRowSelector();

        return $grid;
    }

    public function showaboutcomment(Request $request )
    {
        $id = $request->get('id');

//        return $content->body($this->detail($id)) ;
        return $this->detail($id);
    }

    public function  detail($id)
    {
        $show = new Show(ProductComment::findOrFail($id));

        $show->product_comment_id('id');
        $show->product_form_id('订单号')->using(ProductForm::findPostIdByProductFormId());
        $show->menber_id('用户')->using(Member::findMemberNameById());
        $show->product_id('商品')->using(Product::findProductNameById());
//        $show->sku_id('属性规格')->as(function ($val){
//            return ProductSku::findskuvaluebyskuid($val);
//        });
        $show->haoping('评价')->unescape()->as(function ($val){
            $feel = ProductComment::productCommentHaoping();
            switch ($val) {
                case ProductComment::ZHONGPING:
                    return "<span class='label label-warning'>$feel[$val]</span>";
                    break;
                case ProductComment::HAOPING:
                    return "<span class='label label-success'>$feel[$val]</span>";
                    break;
                case ProductComment::CHAPING:
                    return "<span class='label label-danger'>$feel[$val]</span>";
                default :
                    return $val;
            }
        });
        $show->comment('评论');
        $show->comment_pic('评论图片')->unescape()->as(function ($img){
            $str = '';
            if($img){
                foreach ($img as $val){
                    $str .= '<img src="'.$val.'" height="200px;"/>';
                }
            }
            return $str;
        });
        $show->created_at('评论时间');


        //去调多余的按钮
        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableList();
            $tools->disableDelete();
        });
        return  $show;

    }

}
