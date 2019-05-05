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
        $search = trim(request('search'));
        if(!$search){
            return back();
        }
        $product = Product::searchProduct($search);
//        dd($product);
        return view('Home.searchList',['product' => $product]);
    }
}