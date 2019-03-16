<?php

namespace App\Api\Controllers;


use App\Model\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

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
        $oldPassword = $request->input('oldPassword');
        $password = $request->input('password');
        $data = $request->all();
        $rules = [
            'oldPassword'=>'required|between:6,20',
            'password'=>'required|between:6,20|confirmed',
        ];
        $messages = [
            'required' => '密码不能为空',
            'between' => '密码必须是6~20位之间',
            'confirmed' => '新密码和确认密码不匹配'
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules, $messages);
        $user = Auth::user();
        $validator->after(function($validator) use ($oldPassword, $user) {
            if (!\Hash::check($oldPassword, $user->password)) {
                $validator->errors()->add('oldPassword', '原密码错误');
            }
        });
        if ($validator->fails()) {
            return back()->withErrors($validator);  //返回一次性错误
        }
        $user->password = bcrypt($password);
        $user->save();
        Auth::logout();  //更改完这次密码后，退出这个用户
        return redirect('/');
    }
}
