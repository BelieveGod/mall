<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;

class ProductController extends Controller
{
    //
    public function index()
    {
        return view('Home.product');
    }
}