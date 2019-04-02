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

    public function applySuccess()
    {
        return view('Home.applySuccess');
    }

    public function findApplyAdmin()
    {
        return view('Home.findApplyAdmin');
    }
}