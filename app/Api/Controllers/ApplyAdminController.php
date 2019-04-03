<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Store;
use App\Model\StoreLog;
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

    //查看申请结果
    public function findTheResultByTel(Request $request)
    {
        $data = [];
        $temp = [];
        $tel = $request->get('tel');
        $store_form_id = Store::where('business_tel' , $tel)->value('store_id');
        $res = StoreLog::where('store_form_id' , $store_form_id)->get()->toArray();
        if(!$res){
            return $data;
        }
        $store = Store::where('business_tel' , $tel)->first()->toArray();
        //数据处理
        foreach ($res as $value){
            foreach ($value as $k=>$v){
                if($k=='action_status'){
                    switch ($v){
                        case Store::PENDING_APPLICATION:
                            $value[$k] = '待审核';
                            break;
                        case Store::APPLICATION_PASSED:
                            $value[$k] = '通过';
                            break;
                        case Store::APPLICATION_FAILED:
                            $value[$k] = '不通过';
                            break;
                    }
                    $temp[] = $value;
                }
            }

        }
        foreach ($temp as $value){
            $value['store'] = $store;
            $data[] = $value;
        }
        return $data;
    }


}