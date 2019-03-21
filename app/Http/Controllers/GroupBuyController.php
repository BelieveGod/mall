<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;

class GroupBuyController extends Controller
{
    //
    public function index()
    {
        return view('Home.groupBuy');
    }
}