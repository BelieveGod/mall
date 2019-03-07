<?php

namespace App\Http\Controllers;

use App\Model\Footer;
use App\Model\Menu;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $menu = Menu::findMenuToHome();
        $footer = Footer::findFooterToHome();
//        dd($footer);
        return view('Home.Index.index',['menu'=>$menu , 'footer'=>$footer]);
    }
}
