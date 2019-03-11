<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form\GaodeMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadImgController extends Controller
{
    public function upload(){
        $file = request()->file('img');

        if($file->isValid()){
            $clientName = $file->getClientOriginalName();
            $entension = $file->getClientOriginalExtension();
            $newName = strtotime(date("Y-m-d")).'/'.md5(date("Y-m-d H:i:s")) . "." . $entension;
            $filePath = $file->storeAs('uploadImg', $newName);
            $filePath = '/../storage/'. $filePath;
            return $filePath;
        }
    }

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
