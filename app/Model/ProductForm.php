<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class ProductForm extends Common
{
    protected $table = 'product_form';
    protected $primaryKey = 'form_id';

    const PLACE_ORDER = 0; //提交订单
    const WAIT_DELIVER_GOODS = 1; //待发货
    const DELETED_ORDER_NO_PAY = 2; //取消订单未付款
    const DELETED_ORDER_NO_DELIVER = 3;//取消订单已付款未发货
    const DELIVER_GOODS = 4; //订单已发货
    const SIGN_FOR_GOOD = 5; //订单已签收
    const FORM_REFUND = 6; //退款
    const RETURN_GOODS = 7; //退货
    const FORN_ABNORMAL = 8; //订单异常
    const READY_GOOG = 9;//评价完商品，交易完成

    const PAY_ON_LINE = 1; //线上付款
    const PAY_UNDER_LINE = 2; //货到付款

    const DISPLAY = 1; //显示
    const UN_DISPLAY = 0; //不显示

    /**
     * 订单状态
     */
    public static function productFormSatus()
    {
        return [
            self::PLACE_ORDER => '提交订单',
            self::WAIT_DELIVER_GOODS => '待发货',
            self::DELETED_ORDER_NO_PAY => '取消订单未付款',
            self::DELETED_ORDER_NO_DELIVER => '取消订单已付款未发货',
            self::DELIVER_GOODS => '订单已发货',
            self::SIGN_FOR_GOOD => '订单已签收',
            self::FORM_REFUND => '退款',
            self::RETURN_GOODS => '退货',
            self::FORN_ABNORMAL => '订单异常',
            self::READY_GOOG => '交易完成',
        ];
    }

    /**
     * 付款方式
     */
    public static function productFormPayType()
    {
        return [
            self::PAY_ON_LINE => '线上支付',
            self::PAY_UNDER_LINE => '货到付款',
        ];
    }

    /**
     *
     */
    public static function LogisticsCompany()
    {
        return [
            'yunda ' => '韵达快递',
            'zhongtong ' => '中通快递',
            'shentong ' => '申通快递',
            'yuantong ' => '圆通快递',
            'baishihuitong ' => '百世汇通',
        ];
    }

    /**
     * 查找订单号
     */
    public static function findPostIdByProductFormId()
    {
        return ProductForm::pluck('post_num' , 'form_id')->toArray();
    }

    /**
     * 前台用户查看订单
     * @param $user_id
     * @return array
     */
    public static function findOrderByUser($user_id , $status = [self::DELIVER_GOODS])
    {
        $productForm = ProductForm::where('user_id',$user_id)->whereIn('status' , $status)->orderBy('status')->get()->toArray();
        //做相应的数据处理
        $userProOrder = [];
        foreach ($productForm as $value){
            foreach ($value as $k=>$v){
                if($k == 'product_id'){
                    $temp = [];
                    foreach ($v as $val){
                        $temp[] = Product::where('product_id',$val)->first()->toArray();
                    }
                    $value['pro'] = $temp;
                }
                if($k == 'status'){
                    $arr = self::productFormSatus();
                    $value['status_name'] = $arr[$v];
                }
            }
            $userProOrder[] = $value;
        }

        return $userProOrder;
    }

    /**
     * 计算不同状态订单的数量
     * @param $user_id
     * @return mixed
     */
    public static function countOrder($user_id)
    {
        //SELECT count(1)as num , `status` FROM mall_product_form WHERE user_id=2 GROUP BY `status`
        return ProductForm::select('status',DB::raw('count(1) as order_num'))
            ->where('user_id',$user_id)->groupBy('status')->get()->toArray();
    }

    public static function findProductByFormId($form_id)
    {
        $order = ProductForm::where('form_id' , $form_id)->first()->toArray();
        //数据过滤
        $product = [];
        foreach ($order['product_id'] as $value){
            $product[] = Product::where('product_id' , $value)->first()->toArray();
        }
        $order['pro'] = $product;
        return $order;
    }

    //pay_time过滤器
    public function getPayTimeAttribute()
    {
        return date('Y-m-d H:i:s',$this->attributes['pay_time']);
    }

    //product_id 修改器
    public function getProductIdAttribute($val)
    {
        return json_decode($val, true);
    }
    //num 修改器
    public function getNumAttribute($val)
    {
        return json_decode($val, true);
    }
    //一对一关联关系  关联商品表
    public function product()
    {
        return $this->hasOne(Product::class,'product_id','product_id');
    }
}
