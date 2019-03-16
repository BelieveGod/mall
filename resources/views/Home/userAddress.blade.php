@extends('Home.memberInfo')

@section('info')
<div class="user_right">
    <div class="user_Borders">
        <div class="title_name">
            <span class="name">地址管理</span>
        </div>
        <div class="about_user_info">
            <form id="form1" name="form1" method="post" action="/api/addAddress">
                <div class="user_layout">
                    <ul>
                        <li>
                            <label class="user_title_name">收件人姓名：</label>
                            <input name="name" type="text" class="add_text">
                        </li>
                        <li>
                            <label class="user_title_name">手 机 号：</label>
                            <input name="tell" type="text" class="add_text">
                        </li>
                        <li>
                            <label class="user_title_name">镇&nbsp;&nbsp;区：</label>
                            <select style="" class="add_text" name="region">
                                <option>请选择</option>
                                @foreach($address as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <label class="user_title_name">详细地址：</label>
                            <input name="address" type="text" class="add_text">
                        </li>
                        <li>
                            <label class="user_title_name">设默认地址：</label>
                            <input type="checkbox" id="chk" name="status">
                            <label for="chk"></label>
                        </li>
                    </ul>
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id"/>
                    <input type="hidden" value="{{isset($list['id'])?$list['id']:null}}" name="id"/>
                    <div class="operating_btn">
                        <button name="up" type="submit" class="submit—btn">确&nbsp;&nbsp;&nbsp;定</button>
                    </div>
                </div>
            </form>
        </div>
        <!--地址列表-->
        <div class="Address_List">
            <div class="title_name"><span class="name">用户地址列表</span></div>
            <div class="list">
                <table id="chkList">
                    <thead>
                        <td class="list_name_title0">收件人姓名</td>
                        <td class="list_name_title1">地区</td>
                        <td class="list_name_title3">电话</td>
                        <td class="list_name_title4">收货地址</td>
                        <td class="list_name_title2">设默认地址</td>
                        <td class="list_name_title5">操作</td>
                    </thead>
                    @foreach($list as $value)
                    <tr>
                        <td>{{$value['name']}}</td>
                        <td>{{$value['region']}}</td>
                        <td>{{$value['tell']}}</td>
                        <td>{{$value['address']}}</td>
                        <td>
                            <input type="checkbox"  name="status" {{$value['status']==1?'checked':null}}>
                            <label for="chk"></label></td>
                        <td><a href="#">修改</a><a href="#">删除</a></td>
                    </tr>
                    @endforeach


                </table>
            </div>
        </div>
    </div>
</div>
@endsection