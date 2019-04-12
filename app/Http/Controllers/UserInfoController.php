<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Member;
use App\Model\Product;
use App\Model\ProductForm;
use App\Model\Regions;
use App\Model\UserAddress;
use App\Model\UserCollect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends HomeController
{
    protected function userInfo()
    {
        $user_id = Auth::user()->id;
        return Member::findUserInfoByUserId($user_id);
    }
    //个人信息
    public function index()
    {
        return view('Home.userInfo',['userInfo'=>$this->userInfo()]);
    }
    //修改密码
    public function resetPassword()
    {
        return view('Home.resetPassword',['userInfo'=>$this->userInfo()]);
    }
    //我的订单
    public function userForm()
    {
        //todo 根据productForm表查找
        //查出所有有关与于这个用户的订单
        $user_id = Auth::user()->id;
        $allOrder = ProductForm::findOrderByUser($user_id);
//        dd($allOrder);
        return view('Home.userForm',[
            'userInfo' => $this->userInfo(),
            'allOrder' => $allOrder,
            ]);
    }
    //我的积分
    public  function userIntegral()
    {
        return view('Home.userIntegral',['userInfo'=>$this->userInfo()]);
    }
    //我的收藏
    public function userCollect()
    {
        $user_id = Auth::user()->id;
        $collect = UserCollect::findAllUserCollect($user_id);

//        dd($collect);
        return view('Home.userCollect' , ['userInfo'=>$this->userInfo() , 'collect'=>$collect]);
    }
    //收货地址
    public function userAddress($id=0)
    {
        $address = Regions::findDongGuan();
        $addlist = UserAddress::where('user_id' , Auth::user()->id)->get()->toArray();
        $list = [];
        $user_address = '';
        if($id){
            $user_address = UserAddress::where('user_address_id' , $id)->first()->toArray();
        }
        foreach ($addlist as $value)
        {
            $value['region'] = Regions::finNameById($value['region']);
            $list[] = $value;
        }
        return view('Home.userAddress' , [
            'userInfo'=>$this->userInfo(),
            'address'=>$address,
            'list'=>$list,
            'user_address'=>$user_address,
            ]);
    }
}