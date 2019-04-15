<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class Integral extends Common
{
    //
    protected $table = 'integral';
    protected $primaryKey = 'integral_id';

    /**
     * 计算用户的总积分
     * @param $user_id
     * @return mixed
     */
    public static function countUserIntegral($user_id)
    {
        return Integral::select(DB::raw('sum(integral)as count_num'))->where('user_id' , $user_id)->groupBy('user_id')->first()->toArray();
    }

    public static function findUserAllIntegral($user_id)
    {
        $data = [];
        $integral = Integral::where('user_id' , $user_id)->get()->toArray();
        //数据过滤
        foreach ($integral as $value){
            foreach ($value as $k=>$v){
                if($k == 'product_form_id'){
                    $value['form_num'] = ProductForm::where('form_id' , $v)->value('form_num');
                }
            }
            $data[] = $value;
        }
        return $data;
    }

}
