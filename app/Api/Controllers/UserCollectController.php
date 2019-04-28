<?php

namespace App\Api\Controllers;

use App\Model\UserCollect;
use Illuminate\Http\Request;

class UserCollectController
{
    //加入收藏夹功能
    public function addCollect(Request $request)
    {
        $product_id = $request->post('product_id');
        $user_id = $request->post('user_id');

        //收藏夹有的就不在创建了
//        $userCollect = new UserCollect;
//        $userCollect->product_id = $product_id;
//        $userCollect->user_id = $user_id;
//        $userCollect->save();
        $collect = UserCollect::firstOrCreate(['product_id' => $product_id , 'user_id' => $user_id]);

        return $collect;
    }

    //删除收藏夹的商品
    public function delCollect(Request $request)
    {
        $collect_id = $request->post('collect_id');
        $collect = UserCollect::findOrFail($collect_id);
        $collect->delete();
        if ($collect->trashed()) {
            return '该记录已删除';
        }
    }


}
