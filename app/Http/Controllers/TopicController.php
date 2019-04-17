<?php

namespace App\Http\Controllers;


class TopicController extends Controller
{
    public function index()
    {
        return view('Home.topicList');
    }


}