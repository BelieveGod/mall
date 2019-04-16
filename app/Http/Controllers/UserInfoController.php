<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Integral;
use App\Model\Member;
use App\Model\Product;
use App\Model\ProductComment;
use App\Model\ProductForm;
use App\Model\Regions;
use App\Model\UserAddress;
use App\Model\UserCollect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserInfoController extends HomeController
{
    protected function userInfo()
    {
        $user_id = Auth::user()->id;
        return Member::findUserInfoByUserId($user_id);
    }
    //首页
    public function index()
    {
        return $this->userForm();
    }
    //个人信息
    public function info()
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
        $status = \request('status');
        $status_arr = [];
        if($status){
            $status_arr[] = $status;
            if($status == ProductForm::FORM_REFUND){
                $status_arr[] = ProductForm::RETURN_GOODS;
                $status_arr[] = ProductForm::FORN_ABNORMAL;
            }else if($status == ProductForm::FORN_ABNORMAL){
                $status_arr[] = ProductForm::WAIT_DELIVER_GOODS;
                $status_arr[] = ProductForm::DELETED_ORDER_NO_PAY;
                $status_arr[] = ProductForm::DELETED_ORDER_NO_DELIVER;
                $status_arr[] = ProductForm::DELIVER_GOODS;
                $status_arr[] = ProductForm::SIGN_FOR_GOOD;
                $status_arr[] = ProductForm::FORM_REFUND;
                $status_arr[] = ProductForm::RETURN_GOODS;
                $status_arr[] = ProductForm::PLACE_ORDER;
                $status_arr[] = ProductForm::READY_GOOG;
            }
            $allOrder = ProductForm::findOrderByUser($user_id , $status_arr);
        }else{
            $allOrder = ProductForm::findOrderByUser($user_id);
        }

        //计算每种状态的情况
        $order_num = ProductForm::countOrder($user_id);
        //初始化
        $dfh = 0;
        $dsh = 0;
        $shouhou = 0;
        $ddpj = 0;
        foreach ($order_num as $value){
            if($value['status'] == ProductForm::WAIT_DELIVER_GOODS){
                $dfh = $value['order_num'];//代发货
            }else if($value['status'] == ProductForm::DELIVER_GOODS){
                $dsh = $value['order_num'];//待收货
            }else if($value['status'] == ProductForm::SIGN_FOR_GOOD){
                $ddpj = $value['order_num'];//商品评价
            }else if($value['status'] == ProductForm::FORM_REFUND||$value['status'] == ProductForm::RETURN_GOODS||$value['status'] == ProductForm::FORN_ABNORMAL){
                $shouhou += $value['order_num'];//售后
            }
        }

        return view('Home.userForm',[
            'userInfo' => $this->userInfo(),
            'allOrder' => $allOrder,
            'dfh' => $dfh,
            'dsh' => $dsh,
            'ddpj' => $ddpj,
            'shouhou' => $shouhou,
            ]);
    }
    //我的积分
    public  function userIntegral()
    {
        $user_id = Auth::user()->id;
        $countUserIntegral = Integral::countUserIntegral($user_id);
        $integral_list = Integral::findUserAllIntegral($user_id);
//        dd($integral_list);

        return view('Home.userIntegral',[
            'userInfo'=>$this->userInfo(),
            'countUserIntegral'=>$countUserIntegral,
            'integral_list'=>$integral_list,
            ]);
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
    //我的评论
    public function userComment()
    {
        $user_id = Auth::user()->id;
        $comment = ProductComment::findCommentByUserId($user_id);
//        dd($comment);

        return view('Home.userComment',['userInfo'=>$this->userInfo(),'comment'=>$comment]);
    }

    //添加评论商品
    public function createdComment()
    {
        $form_id = \request('id');
        $comment_list = ProductForm::findProductByFormId($form_id);
        return view('Home.addUserComment',['userInfo'=>$this->userInfo(),'comment_list'=>$comment_list]);
    }
}