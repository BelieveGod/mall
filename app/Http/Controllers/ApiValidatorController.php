<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use App\Model\Store;
use App\Model\StoreLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiValidatorController extends Controller
{
    //商家申请 (包括创建申请和更新)
    public function addApply(Request $request)
    {
        //获取提交数据
        $business_nickname = $request->post('business_nickname');
        $store_name = $request->post('store_name');
        $address = $request->post('address');
        $business_name = $request->post('business_name');
        $business_tel = $request->post('business_tel');
        $identity_card = $request->post('identity_card');
        $post_num = $request->post('post_num');
        $business_pic = $request->post('adminImg');
//        $apply_id = $request->post('apply_id')?$request->post('apply_id'):mt_rand(100000000,199999999);

        $credentials = $request->all();

//        dd($credentials);

        //表单验证
        $rules = [
            'business_nickname'=>'required',
            'store_name'=>'required',
            'address'=>'required',
            'business_name'=>'required',
            'identity_card'=>'required',
            'post_num'=>'required|numeric',
            'business_tel' => 'required|numeric|unique:store',
            'adminImg'=>'required',
        ];
        $messages = [
            'business_nickname.required' => '昵称不能为空',
            'store_name.required' => '店名不能为空',
            'address.required' => '地址不能为空',
            'business_name.required' => '实名不能为空',
            'identity_card.required' => '身份证不能为空',
            'post_num.required' => '邮编不能为空',
            'business_tel.required' => '手机号不能为空',
            'adminImg.required' => '请上传实名照片！',
            'numeric' => '填写的格式错误',
            'unique' => '手机号被使用',
        ];
       Validator::make($credentials , $rules , $messages)->validate();

       //验证通过 将数据写入数据库
        $store = new Store;
        $store->business_nickname = $business_nickname;
        $store->store_name = $store_name;
        $store->address = $address;
        $store->business_name = $business_name;
        $store->business_tel = $business_tel;
        $store->identity_card = $identity_card;
        $store->post_num = $post_num;
        $store->business_pic = json_encode($business_pic);
        $store->status = Store::PENDING_APPLICATION;
        $store->blacklist = 0;
//        $store->apply_id = $apply_id;
        $store->save();

        //写入申请日志
        $store_log = new StoreLog;
        $store_log->store_form_id = $store->store_id;
        $store_log->action_status = Store::PENDING_APPLICATION;
        $store_log->save();

        //成功后 返回查询页面
        return redirect('/applySuccess');
    }
}