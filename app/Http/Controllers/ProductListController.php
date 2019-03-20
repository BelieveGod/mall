<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;

class ProductListController extends Controller
{
    //
    public function index()
    {
        return view('Home.productList');
    }
}