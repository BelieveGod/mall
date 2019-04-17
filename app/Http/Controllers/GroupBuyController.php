<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Product;

class GroupBuyController extends Controller
{
    //活动页面
    public function index($type=Product::SS_PRODUCT)
    {
        if($type == Product::SS_PRODUCT){
            $title = '今日特价';
        }else if($type == Product::NEW_PRODUCT){
            $title = '最新促销';
        }
        $product = Product::todayDeal($type);
        return view('Home.groupBuy',['product'=>$product,'title'=>$title]);
    }
}