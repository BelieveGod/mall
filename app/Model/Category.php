<?php

namespace App\Model;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class Category extends Common
{
    use ModelTree, AdminBuilder;

    protected $table = 'category';
    protected $primaryKey = 'category_id';

    const DISPLAY = 1; //显示
    const UN_DISPLAY = 0; //不显示

    //模型树
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('pid');
        $this->setOrderColumn('sort_order');
        $this->setTitleColumn('category_name');
    }
//    //查找父级目录
//    public static function parentsId()
//    {
//        $data = [];
//        $root = Category::where('pid','0')->pluck('category_name','category_id')->toArray();
//
//        foreach ($root as $key => $value){
//            $data[$key] = $value;
//            $parents = Category::where('pid',$key)->pluck('category_name','category_id')->toArray();
//            foreach ($parents as $key1 => $value1){
//                $data[$key1] = '&nbsp;&nbsp;&nbsp;&nbsp;'.$value1;
//                $child =  Category::where('pid',$key1)->pluck('category_name','category_id')->toArray();
//                foreach ($child as $key2 => $value2){
//                    $data[$key2] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value2;
//                }
//            }
//        }
//        return $data;
//    }

    //查找父级目录
    public static function parentsId()
    {
        $root = Category::where('pid','0')->pluck('category_name','category_id')->toArray();
        self::allChildren($root , $data);
        return $data;
    }

    //递归 商品分类导航
    public static function allChildren($root , &$data = [] , $strNbsp = null)
    {
        $strNbsp .= '&nbsp;&nbsp;&nbsp;&nbsp;';
        foreach ($root as $key => $value){
            $data[$key] = $strNbsp.$value;
            $parents = Category::where('pid',$key)->pluck('category_name','category_id')->toArray();
            if(is_array($parents)){
                self::allChildren($parents , $data , $strNbsp);
            }
        }

    }

    //home 商品导航 已知顶级id
    public static function findCategoryByPid($id)
    {
        $menu = Category::where([['pid' , $id],['is_show' , self::DISPLAY]])->pluck('category_name' , 'category_id')->toArray();
        $data = [];
        $temp = [];
        foreach ($menu as $key=>$value){
            $temp['type'] = $value;
            $temp['cvn'] = Category::where([['pid' , $key],['is_show' , self::DISPLAY]])->pluck('category_name' , 'category_id')->toArray();
            $data[] = $temp;
        }
        return $data;
    }

    // 递归 找最顶级的父id
    public static function findTheTopPid($id , &$top_id , &$str='')
    {
        $category = Category::where('category_id' , $id)->first()->toArray();
        $top_id = $category['category_id'];
        $str .= $category['category_id'].'/';
        if($category['pid'] != 1 ){
            self::findTheTopPid($category['pid'] , $top_id , $str);
        }
    }




}
