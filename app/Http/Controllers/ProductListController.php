<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Category;
use App\Model\Product;

class ProductListController extends Controller
{
    //
    public function index($id)
    {
        //菜单目录 如果不是最顶级 则找到最顶级的目录
        $top_id = '';
        $pid = Category::where('category_id' , $id)->value('pid');
        if($pid != 1){
            Category::findTheTopPid($id,$top_id);
            $menu = Category::findCategoryByPid($top_id);
            $menu_title = Category::where('category_id' , $top_id)->first()->toArray();
            //商品展示
            $product = Product::findProductUrlById($id);
        }else{
            $menu = Category::findCategoryByPid($id);
            $menu_title = Category::where('category_id' , $id)->first()->toArray();
            //商品展示
            $product = Product::findProductUrlByTopId($id);
        }
//        dd($product->render());
//        dd($product);

        return view('Home.productList' , [
            'menu' => $menu,
            'menu_title' => $menu_title,
            'product' => $product,
        ]);
    }
}