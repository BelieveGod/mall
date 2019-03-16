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
    public static function areaoptions($id)
    {
        $province_id = Regions::where('region_id' , $id)->value('parent_id');

        return Regions::where('parent_id' , $province_id)->pluck('region_name','region_id');
    }

    //保存值为region_id 输出地址
    public static function findAddress($id)
    {
        $county = Regions::where('region_id' , $id)->first();
        $city = Regions::where('region_id' , $county->parent_id)->first();
        $province = Regions::where('region_id' , $city->parent_id)->first();

        $address = $province->region_name.'省  '.$city->region_name.'  '.$county->region_name;

        return $address;
    }

    //保存值为region_path 输出地址
    public static function findArea($value)
    {
        $arr = explode(',',$value);

        $str = null;
        foreach ($arr as $val){
            $str .= Regions::where('region_id' , $val)->value('region_name').' ';
        }
        return $str;
    }

    //只找东莞的镇区
    public static function findDongGuan()
    {
        $pid = 441;
        return Regions::where('parent_id' , $pid)->pluck('region_name' , 'region_id')->toArray();
    }
    //根据id找某个名字
    public static function finNameById($id)
    {
        return Regions::where('region_id' , $id)->value('region_name');
    }
}
