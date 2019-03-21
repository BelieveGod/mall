<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;

class CallAboutUsController extends HomeController
{
    //
    public function index()
    {
        return view('Home.callAboutUs');
    }
}