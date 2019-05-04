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

    /**
     * 输出整理好的积分列表
     * @param $user_id
     * @return array
     */
    public static function findUserAllIntegral($user_id)
    {
        $data = [];
//        $integral = Integral::where('user_id' , $user_id)->get()->toArray();
        $integral = Integral::where('user_id' , $user_id)->get();
        //数据过滤
//        foreach ($integral as $value){
//            foreach ($value as $k=>$v){
//                if($k == 'product_form_id'){
//                    $product_form = ProductForm::where('form_id' , $v)->first();
//                    $value['form_num'] = $product_form->form_num;
//                    $value['cost'] = $product_form->form_cost;
//                }
//            }
//            $data[] = $value;
//        }
        //代码优化
        foreach ($integral as $value) {
            $value['form_num'] =$value->productForm->form_num;
            $value['cost'] = $value->productForm->form_cost;
            $data[] = $value->toArray();
        }
        return $data;
    }

    //一对一关联  订单表
    public function productForm()
    {
        return $this->hasOne(ProductForm::class,'form_id','product_form_id');
    }

}
