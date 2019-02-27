<?php

namespace App\Model;

class BusinessAddress extends Common
{
    protected $table = 'business_address';
    protected $primaryKey = 'business_address_id';

    public static function findaddressbyid()
    {
        return BusinessAddress::where('store_id' , 0)->pluck('address' , 'business_address_id')->toArray();
    }

}
