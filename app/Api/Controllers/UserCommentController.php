<?php

namespace App\Api\Controllers;

use App\Model\Product;
use App\Model\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserCommentController
{
    //提交评论
    public function createdComment(Request $request)
    {
        $menber_id = $request->post('menber_id');
        $comment = $request->post('comment');
        $haoping = $request->post('haoping');
        $product_id = $request->post('product_id');
        $product_form_id = $request->post('product_form_id');
        $comment_pic = $request->post('comment_pic');
        $store_id = $request->post('store_id');
        $is_show = Product::DISPLAY;

        for ($i = 0 ; $i < count($haoping) ; $i++){
            $product_comment = new ProductComment;

            $product_comment->menber_id = $menber_id;
            $product_comment->comment = $comment[$i];
            $product_comment->haoping = $haoping[$i];
            $product_comment->product_id = $product_id[$i];
            $product_comment->product_form_id = $product_form_id;
            $product_comment->comment_pic = json_encode($comment_pic);
            $product_comment->store_id = $store_id;
            $product_comment->is_show = $is_show;

            $product_comment->save();
        }
        return redirect('/user_comment');
    }

    //上传图片
    public function uploadImg()
    {
        $file = request()->file('img');
        if($file->isValid()){
            $clientName = $file->getClientOriginalName();
            $entension = $file->getClientOriginalExtension();
            $newName = strtotime(date("Y-m-d")).'/'.md5(date("Y-m-d H:i:s")) . "." . $entension;
            $filePath = $file->storeAs('UserComment', $newName);
            $filePath = '/../storage/'. $filePath;
            return $filePath;
        }
    }

    //图片删除
    public function deletedImg(Request $request)
    {
        $filePath = $request->get('del');
        $fileName = substr($filePath,12);
        Storage::delete($fileName);
//        var_dump($filePath);
//        dd($filePath);
        return '图片删除成功';
    }




}
