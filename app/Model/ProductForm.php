<?php

namespace App\Model;

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

    const PAY_ON_LINE = 1; //线上付款
    const PAY_UNDER_LINE = 2; //货到付款

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
    public static function findOrderByUser($user_id)
    {
        $productForm = ProductForm::where('user_id',$user_id)->get()->toArray();
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
            }
            $userProOrder[] = $value;
        }
        return $userProOrder;
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

}
