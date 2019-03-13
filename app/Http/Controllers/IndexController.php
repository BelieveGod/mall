<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;

class IndexController extends Controller
{
    //
    public function index()
    {
        $ad_st = Advertisement::findAdvertisementImg(Advertisement::TIMING_LANTERN_SLIDE);
        $ad_nd = Advertisement::findAdvertisementImg(Advertisement::FAN_STYLE);
        $ad_rd = Advertisement::findAdvertisementImg(Advertisement::LANTERN_SLIDE);
//        dd($ad_rd);
        return view('Home.index',[
            'ad_st' => $ad_st,
            'ad_nd' => $ad_nd,
            'ad_rd' => $ad_rd,
        ]);
    }
}
