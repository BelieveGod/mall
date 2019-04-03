<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Category;
use App\Model\Product;
use App\Model\Store;

class ApplyAdminController extends Controller
{

    public function index()
    {
        return view('Home.applyAdmin');
    }
    //显示申请成功页面
    public function applySuccess()
    {
        return view('Home.applySuccess');
    }
    //商家查找
    public function findApplyAdmin()
    {
        return view('Home.findApplyAdmin');
    }
    //修改 重新写修改页面 Q.Q
    public function updatedApplyAdmin($id=0)
    {
        $store = Store::where('store_id' , $id)->first();
        dd($store);
        return view('Home.updatedApplyAdmin' ,['store'=>$store]);
    }


}