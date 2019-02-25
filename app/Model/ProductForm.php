<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductForm extends Model
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

}
