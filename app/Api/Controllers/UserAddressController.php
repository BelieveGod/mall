<?php

namespace App\Api\Controllers;


use App\Model\UserAddress;
use Illuminate\Http\Request;

class UserAddressController
{
    public function addAddress(Request $request)
    {
        $name = $request->post('name');
        $tell = $request->post('tell');
        $region = $request->post('region');
        $address = $request->post('address');
        $status = $request->post('status');
        $user_id = $request->post('user_id');
        $id = $request->post('id');
        //判断是创建还是更新
        if($id){
            $userAddress = UserAddress::find($id);
        }else{
            $userAddress = new UserAddress;
        }
        $userAddress->name = $name;
        $userAddress->tell = $tell;
        $userAddress->region = $region;
        $userAddress->address = $address;
        $userAddress->status = $status=='on'?1:0;
        $userAddress->user_id = $user_id;
        $userAddress->save();
        return redirect( '/userAddress');
    }
}
