<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Category;
use App\Model\Product;

class ApplyAdminController extends Controller
{
    //
    public function index()
    {
        return view('Home.applyAdmin');
    }
}