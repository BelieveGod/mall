<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;

class UserInfoController extends HomeController
{
    //
    public function index()
    {
        return view('Home.userInfo',[]);
    }
}