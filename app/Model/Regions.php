<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    protected $table = 'regions';
    protected $keyType = 'region_id';

    public static function province()
    {
        return Regions::where('region_grade' , 1)->pluck('region_name','region_id');
    }

    public static function findAddress($id)
    {
        $county = Regions::where('region_id' , $id)->first();
        $city = Regions::where('region_id' , $county->parent_id)->first();
        $province = Regions::where('region_id' , $city->parent_id)->first();

        $address = $province->region_name.'省  '.$city->region_name.'  '.$county->region_name;

        return $address;
    }
}
