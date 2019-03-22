<?php

namespace App\Api\Controllers;


use App\Model\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class UserInfoController
{
    //表单提交的信息
    public function upUserInfo(Request $request)
    {
        $member_name = $request->post('member_name');
        $member_sex = $request->post('member_sex');
        $member_tel = $request->post('member_tel');
        $member_birth = $request->post('member_birth');
        $users_id = $request->post('users_id');
        $blacklist = $request->post('blacklist');
        $vip = $request->post('vip');
        $member_pic = $request->post('upload_img');
        //图片路径处理
//        $member_pic = substr($member_pic,12);
        $data = [
            'member_name' => trim($member_name),
            'member_sex' => $member_sex,
            'member_tel' => trim(str_replace(' ' ,'',$member_tel)),
            'member_birth' => strtotime($member_birth),
            'blacklist' => $blacklist,
            'vip' => $vip,
            'member_pic' => $member_pic,
        ];
        $userInfo = Member::updateOrCreate(['users_id' => $users_id] , $data);
        return redirect( '/userInfo');
    }

    //上传图片
    public function uploadImg()
    {
        $file = request()->file('member_pic');
        if($file->isValid()){
            $clientName = $file->getClientOriginalName();
            $entension = $file->getClientOriginalExtension();
            $newName = strtotime(date("Y-m-d")).'/'.md5(date("Y-m-d H:i:s")) . "." . $entension;
            $filePath = $file->storeAs('uploadImg', $newName);
            $filePath = '/../storage/'. $filePath;
            return $filePath;
        }
    }

    //todo 重置密码
    public function postReset(Request $request)
    {
        $oldPassword = $request->input('oldpassword');
        $password = $request->input('password');
        $data = $request->all();
        $credentials = $request->only(['oldpassword', 'password']);
        $rules = [
//            'oldPassword'=>'required|between:6,20',
//            'password'=>'required|between:6,20|confirmed',
            'oldpassword'=>'required',
            'password'=>'required',
        ];
        $messages = [
            'oldPassword.required' => '密码不能为空',
            'between' => '密码必须是6~20位之间',
            'password.confirmed' => '新密码和确认密码不匹配'
        ];
        $validator = Validator::make($credentials, $rules);
//        if($validator->fails()){
//            return Redirect::back()->withErrors($validator)->withInput(Input::get());
//        }
//        $user = Auth::user();
//        $validator->after(function($validator) use ($oldPassword, $user) {
//            if (!Hash::check($oldPassword, $user->password)) {
//                $validator->errors()->add('oldpassword', '原密码错误');
//            }
//        });
//        if ($validator->fails()) {
//            return back()->withErrors($validator);
//        }
        if ($validator->fails()) {
//            $errors = $validator->errors()->getMessages();
//            dd($errors);
            return back()->withErrors($validator)->withInput();
        }


        echo '111';
//        $user->password = bcrypt($password);
//        $user->save();
//        return redirect( '/userInfo');
    }
}
