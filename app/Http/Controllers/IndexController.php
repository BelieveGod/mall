<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Footer;
use App\Model\Menu;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $menu = Menu::findMenuToHome();
        $footer = Footer::findFooterToHome();
        $ad_st = Advertisement::findAdvertisementImg(Advertisement::TIMING_LANTERN_SLIDE);
        $ad_nd = Advertisement::findAdvertisementImg(Advertisement::FAN_STYLE);
        $ad_rd = Advertisement::findAdvertisementImg(Advertisement::LANTERN_SLIDE);
//        dd($ad_rd);
        return view('Home.Index.index',[
            'menu'=>$menu ,
            'footer'=>$footer,
            'ad_st' => $ad_st,
            'ad_nd' => $ad_nd,
            'ad_rd' => $ad_rd,
        ]);
    }
}
