<?php

namespace App\Model;

class Store extends Common
{
    //
    protected $table = 'store';
    protected $primaryKey = 'store_id';

    /** 商家店铺状态 */
    const PENDING_APPLICATION =1;//待审
    const APPLICATION_PASSED = 2;//申请通过
    const APPLICATION_FAILED = 3;//申请不通过

    //状态
    public static function StoreStatus()
    {
        return [
            self::PENDING_APPLICATION => '待审核',
            self::APPLICATION_PASSED => '通过',
            self::APPLICATION_FAILED => '不通过'
        ];
    }
}