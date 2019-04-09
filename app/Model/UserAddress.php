<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Common
{
    protected $table = 'user_address';
    protected $primaryKey = 'user_address_id';

    public static function findUserAddress($user_id)
    {
        $data = [];
        //限制最多显示4个地址
        $user_address = UserAddress::where('user_id' , $user_id)->limit(4)->get()->toArray();
        foreach ($user_address as $value){
            $value['region_name'] = Regions::where('region_id' , $value['region'])->value('region_name');
            $data[] = $value;
        }
        return $data;
    }
}
