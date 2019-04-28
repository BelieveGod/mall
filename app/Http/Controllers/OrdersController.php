<?php

namespace App\Http\Controllers;

use App\Model\Member;
use App\Model\Product;
use App\Model\ProductForm;
use App\Model\ShoppingCart;
use App\Model\UserAddress;
use Illuminate\Support\Facades\Auth;

class OrdersController extends HomeController
{
    protected function userInfo()
    {
        $user_id = Auth::user()->id;
        return Member::findUserInfoByUserId($user_id);
    }
    /**
     * 显示订单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $product = [];
        $store = [];
        //获取用户id
        $user_id = Auth::user()->id;
        //显示用户地址
        $user_address = UserAddress::findUserAddress($user_id);
        //显示要支付的商品
        $cart_id = \request()->all();

        //如果提交空表单 跳转到当前页面
        if(!$cart_id){
            return back();
        }

        foreach ($cart_id as $value){
            $product[] = ShoppingCart::where('shopping_cart_id' , $value)->first()->toArray();
        }
        //涉及到的商店
        $store_arr = array_unique(array_column($product,'store_id'));
        $temp = [];
        foreach ($store_arr as $value){
            $temp['store_id'] = $value;
            $store[] = $temp;
        }
        $order = ShoppingCart::displayProduct($store , $product);

//        dd($order);

        return view('Home.Orders',[
            'user_address' => $user_address ,
            'order' => $order,
        ]);
    }

    //立即购买
    public function buyNowOrder()
    {
        //获取用户id
        $user_id = Auth::user()->id;
        //显示用户地址
        $user_address = UserAddress::findUserAddress($user_id);
        $product_id = \request('id');
        $num = \request('num');

        $order = Product::buyProductNow($product_id,$num);
//        dd($order);

        return view('Home.Orders',[
            'user_address' => $user_address ,
            'order' => $order,
        ]);
    }

    //查看物流
    public function showLogistics($id)
    {
        $form = ProductForm::where('form_id' , $id)->first();

        $url='http://www.kuaidi100.com/query?type='.$form->logistics_company.'&postid='.$form->post_num;
        $html = file_get_contents($url);
        $data = json_decode($html,true);
//        dd($data);

        return view('Home.findLogistics' , ['userInfo' => $this->userInfo(),'data'=>$data]);
    }
}