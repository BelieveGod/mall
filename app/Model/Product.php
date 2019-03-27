<?php

namespace App\Model;

class Product extends Common
{
    //
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    const DISPLAY = 1; //显示
    const UN_DISPLAY = 0; //不显示

    const HOT_PRODUCT = 1; //热门商品
    const NEW_PRODUCT = 2; //最新商品
    const RECOMMEND_PRODUCT = 3 ; //推荐商品
    const ORDINARY_PRODUCT = 4 ; //普通商品

    public static function productStatic()
    {
        return [
            self::HOT_PRODUCT => '热门',
            self::NEW_PRODUCT => '最新',
            self::RECOMMEND_PRODUCT => '推荐',
            self::ORDINARY_PRODUCT => '普通',
        ];
    }

    //多图上传
    public function setProductMasterImgAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['product_master_img'] = json_encode($pictures);
        }
    }
    public function getProductMasterImgAttribute($pictures)
    {
        return json_decode($pictures, true);
    }
    public static function findProductNameById()
    {
        return Product::where('is_show' , self::DISPLAY)->pluck('product_name' , 'product_id')->toArray();
    }
    public static function findProductById($id)
    {
        return Product::where('product_id' , $id)->first()->toArray();
    }

    /**
     * 更具url的id查找商品 乱序显示
     * @param $id
     * @param int $limit
     * @return mixed
     */
    public static function findProductUrlByTopId($id , $limit = 0)
    {
        //todo 优化查询 多带点查询条件
        if($limit){
            $product =  Product::where([['category_top_id' , $id] , ['is_show' , self::DISPLAY]])->limit($limit)->get()->toArray();
            shuffle($product);
        }else{
            //一页显示20个商品
            $product =  Product::where([['category_top_id' , $id] , ['is_show' , self::DISPLAY]])->paginate(8);
        }
        //todo 乱序显示商品
//        shuffle($product);
        return $product;
    }
    public static function findProductUrlById($id)
    {
        //一页显示20个商品
        $product =  Product::where([['category_id' , $id] , ['is_show' , self::DISPLAY]])->get()->toArray();
        //乱序显示商品
        shuffle($product);
        return $product;

    }
}
