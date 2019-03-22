<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Suggest;
use Illuminate\Support\Facades\Auth;

class CallAboutUsController extends HomeController
{
    protected function userId()
    {
        return Auth::user()->id;
    }
    //联系我们
    public function index()
    {
        $suggestType = Suggest::suggestType();
        return view('Home.callAboutUs',['suggestType'=>$suggestType]);
    }

    //我的建议
    public function mySuggest()
    {
        $user_id = $this->userId();
        $suggest = Suggest::where('user_id' , $user_id)->orderBy('created_at','desc')->get()->toArray();
//        dd($suggest);
        return view('Home.mySuggest' ,['suggest'=>$suggest]);
    }

}