<?php

namespace App\Api\Controllers;


use App\Model\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController
{
    //添加和修改用户地址
    public function addAddress(Request $request)
    {
        $name = $request->post('name');
        $tell = $request->post('tell');
        $region = $request->post('region');
        $address = $request->post('address');
        $status = $request->post('status');
        $user_id = $request->post('user_id');
        $id = $request->post('id');

        if($status == 'on'){
            $getAllUserAddress = UserAddress::where('user_id' , $user_id)->get();
            foreach ($getAllUserAddress as $value){
                UserAddress::where('user_address_id' , $value->user_address_id)->update(['status' => 0]);
            }
        }
//        dd($getAllUserAddress);

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

    //删除用户地址
    public function deletedUserAddress($id)
    {
        $user_address = UserAddress::find($id);
        $user_address->delete();
        return redirect( '/userAddress');
    }

    //订单直接添加收货地址
    public function orderAddAddress(Request $request)
    {
        $name = $request->post('name');
        $tell = $request->post('tell');
        $region = $request->post('region');
        $address = $request->post('address');
        $user_id = $request->post('user_id');

        $userAddress = new UserAddress;
        $userAddress->name = $name;
        $userAddress->tell = $tell;
        $userAddress->region = $region;
        $userAddress->address = $address;
        $userAddress->status = 0;
        $userAddress->user_id = $user_id;
        $userAddress->save();

        return back();
    }
}
