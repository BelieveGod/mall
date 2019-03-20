<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;

class ShoppingCartController extends HomeController
{
    //
    public function index()
    {
        return view('Home.shoppingCart');
    }
}