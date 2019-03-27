<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Category;
use App\Model\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        //商品列表 分类显示
        $fruit = Product::findProductUrlByTopId(2 , 10);
        $vertable = Product::findProductUrlByTopId(3 , 10);
        $chicken = Product::findProductUrlByTopId(4 , 10);
        $rice = Product::findProductUrlByTopId(5 , 10);
        $jiagong = Product::findProductUrlByTopId(6 , 10);
        $flower = Product::findProductUrlByTopId(7 , 10);
        $nongzi = Product::findProductUrlByTopId(8 , 10);
        $seed = Product::findProductUrlByTopId(9 , 10);

        return view('Home.product',[
            'fruit' => $fruit,
            'vertable' => $vertable,
            'chicken' => $chicken,
            'rice' => $rice,
            'jiagong' => $jiagong,
            'flower' => $flower,
            'nongzi' => $nongzi,
            'seed' =>$seed
        ]);
    }
}