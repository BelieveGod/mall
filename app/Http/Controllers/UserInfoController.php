<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Member;
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
}