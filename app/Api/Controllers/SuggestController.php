<?php

namespace App\Api\Controllers;

use App\Model\Member;
use App\Model\Suggest;
use Illuminate\Http\Request;

class SuggestController
{
    //表单提交的信息
    public function upSuggest(Request $request)
    {
        $suggest_type = $request->post('suggest_type');
        $suggest_attr = $request->post('suggest_attr');
        $text = $request->post('text');
        $user_id = $request->post('user_id');

        $suggest = new Suggest;
        $suggest->suggest_type = $suggest_type;
        $suggest->suggest_attr = $suggest_attr;
        $suggest->text = $text;
        $suggest->user_id = $user_id;

        $suggest->save();

        return redirect( '/mySuggest');
    }


}
