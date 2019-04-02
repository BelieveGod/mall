<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplyAdminController extends Controller
{
    //上传图片
    public function uploadImg()
    {
        $file = request()->file('img');
        if($file->isValid()){
            $clientName = $file->getClientOriginalName();
            $entension = $file->getClientOriginalExtension();
            $newName = strtotime(date("Y-m-d")).'/'.md5(date("Y-m-d H:i:s")) . "." . $entension;
            $filePath = $file->storeAs('applyAdmin', $newName);
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