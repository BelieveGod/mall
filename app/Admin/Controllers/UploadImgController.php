<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form\GaodeMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadImgController extends Controller
{
    public function upload(){
        $file = request()->file('img');

        if($file->isValid()){
//            $url_path = '/uploads/'.time();
            $clientName = $file->getClientOriginalName();
            $entension = $file->getClientOriginalExtension();
            $newName = strtotime(date("Y-m-d")).'/'.md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
            $filePath = $file->storeAs('uploadImg', $newName);
//            $path = $file->move($url_path, $newName);
//            $filePath = storage_path().'/app/'. $filePath;
            $filePath = '/../storage/app/'. $filePath;
            return $filePath;
        }
    }
}
