<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Category;
use App\Model\Product;

class SearchController extends Controller
{
    //
    public function index()
    {
        $search = request('search');

        $product = Product::searchProduct($search);
        return view('Home.searchList',['product' => $product]);
    }
}