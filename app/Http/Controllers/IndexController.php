<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Menu;
use App\Model\Product;

class IndexController extends Controller
{
    //
    public function index()
    {
        //广告图片
        $ad_st = Advertisement::findAdvertisementImg(Advertisement::TIMING_LANTERN_SLIDE);
        $ad_nd = Advertisement::findAdvertisementImg(Advertisement::FAN_STYLE);
        $ad_rd = Advertisement::findAdvertisementImg(Advertisement::LANTERN_SLIDE);
        //店长推荐菜单栏管理
        $menu_list = Menu::where('is_show' , Menu::DISPLAY)->orderBy('sort')->get()->toArray();

        //最新上传得商品
        $fruit = Product::findProductTypeSalesVolumeNew(2,10);
//        dd($fruit);

//        dd($ad_rd);
        return view('Home.index',[
            'ad_st' => $ad_st,
            'ad_nd' => $ad_nd,
            'ad_rd' => $ad_rd,
            'menu_list' => $menu_list,
            'fruit' => $fruit
        ]);
    }
}
