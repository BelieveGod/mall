<?php

namespace App\Api\Controller;


use Illuminate\Http\Request;

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

        $data = [
            'member_name' => trim($member_name),
            'member_sex' => $member_sex,
            'member_tel' => trim(str_replace(' ' ,'',$member_tel)),
            'member_birth' => strtotime($member_birth),
            'users_id' => $users_id,
            'blacklist' => $blacklist,
            'vip' => $vip,
            'member_pic' => $member_pic
        ];
        dd($data);
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
}
