<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Echarts\Echarts;
use Encore\Admin\Widgets\InfoBox;

class DataController extends Controller
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
            ->header('Chartjs')
            ->row(function (Row $row) {
                $row->column(3, new InfoBox('New Users', 'users', 'aqua', '/demo/users', '1024'));
                $row->column(3, new InfoBox('New Orders', 'shopping-cart', 'green', '/demo/orders', '150%'));
                $row->column(3, new InfoBox('Articles', 'book', 'yellow', '/demo/articles', '2786'));
            })
            ->row(function(Row $row){
                $row->column(5, function (Column $column) {
                    $column->row(new Box('本月成交订单', view('Admin.chartjs')));
//                    $column->row(new InfoBox('New Users', 'users', 'aqua', '/demo/users', '1024'));
                });
                $row->column(5, function (Column $column) {
                    $column->row(new Box('本月收入', view('Admin.incomeChartjs')));
                });
            });
//            ->body(new Box('Bar chart', view('Admin.chartjs')));
//        return $content
//            ->header('Index')
//            ->description('description')
//            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
//        $grid = new Grid(new Topic);
//
//        $grid->topic_id('Topic id');
//        $grid->topic_name('Topic name');
//        $grid->topic_dec('Topic dec');
//        $grid->used_id('Used id');
//        $grid->topic_follow('Topic follow');
//        $grid->topic_pic('Topic pic');
//        $grid->status('Status');
//        $grid->created_at('Created at');
//        $grid->updated_at('Updated at');
//        $grid->deleted_at('Deleted at');
//
//        return $grid;
    }

    public function countOrderNumByStore()
    {
        //SELECT count(*)as order_num , created_at FROM mall_product_form WHERE store_id = 1 and created_at>1554048000 and created_at<1556640000 GROUP BY created_at;
        $data = [];
        $firstday = date('Y-m-01',time());
        $start = strtotime($firstday);//本月开始的时间戳
        $end = strtotime("$firstday +1 month -1 day");//本月结束的时间戳
        $lastday = date('d' , $end);

        $month_date = json_encode(range(1,$lastday));

        $data['month_date'] = $month_date;

        return $data;
    }


}
