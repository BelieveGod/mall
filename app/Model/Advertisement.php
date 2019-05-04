<?php

namespace App\Model;


class Advertisement extends Common
{
    //
    protected $table = 'advertisement';
    protected $primaryKey = 'ad_id';

    const DISPLAY = 1; //显示
    const UN_DISPLAY = 0; //不显示

    const TIMING_LANTERN_SLIDE = 1; //上面定时幻灯片
    const FAN_STYLE = 2 ; //中间扇形幻灯片
    const LANTERN_SLIDE = 3; //最下面幻灯片

    public static function advertisementUsed()
    {
        return [
            self::TIMING_LANTERN_SLIDE => '上面定时幻灯片',
            self::FAN_STYLE => '中间扇形幻灯片',
            self::LANTERN_SLIDE => '最下面幻灯片',
        ];
    }

    //home
    public static function findAdvertisementImg($data)
    {
        $ad_img = Advertisement::where([['is_show' , self::DISPLAY],['used' , $data]])->orderBy('sort')->get();
//        $ad_img = Advertisement::where([['is_show' , self::DISPLAY],['used' , $data]])->orderBy('sort')->get()->toArray();
        if($ad_img[0]['product_id'] == null){
            return $ad_img;
        }
        $data = [];
//        foreach ($ad_img as $value){
//            $temp = [];
//            $temp['product'] = Product::findProductById($value['product_id']);
//            foreach ($value as $key=>$val){
//                $temp[$key] = $val;
//            }
//            $data[] = $temp;
//        }
        //代码优化
        foreach ($ad_img as $value){
            $temp = $value->toArray();
            $temp['product'] = $value->product->toArray();
            $data[] = $temp;
        }
        return $data;
    }

    //一对一关联关系  关联商品表
    public function product()
    {
        return $this->hasOne(Product::class,'product_id','product_id');
    }
}
