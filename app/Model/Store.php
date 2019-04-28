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

    const BLACKLIST = 1; // 黑名单

    //状态
    public static function StoreStatus()
    {
        return [
            self::PENDING_APPLICATION => '待审核',
            self::APPLICATION_PASSED => '通过',
            self::APPLICATION_FAILED => '不通过'
        ];
    }

    //通过商店id商店名称
    public static function getStoreNameByStoreId()
    {
        return Store::pluck('store_name' , 'store_id')->toArray();
    }

    //查找黑名单商家
    public static function findBlackListStoreId()
    {
        return Store::where('blacklist' , Store::BLACKLIST)->pluck('admin_id');
    }

//    //修改器 多图上传
//    public function getBusinessPicAttribute($pictures)
//    {
//        return json_decode($pictures, true);
//    }

}
