@extends('Home.memberInfo')

@section('info')
<!--用户中心-->
<div class="user_right">
    <div class="user_Borders">
        <div class="title_name">
            <span class="name">个人信息设置</span>
        </div>
        <div class="about_user_info">
            <form id="form1" name="form1" method="post" action="/api/up_user_info" enctype="multipart/form-data">
                <div class="user_layout">
                    <ul >
                        <li>
                            <label class="user_title_name">用户头像：</label>
                            <label for="upimg" ><img src="{{isset($userInfo->member_pic)?$userInfo->member_pic:'./image/test/5.jpg'}}" width="50px" /></label>
                            <input name="member_pic" type="file" id="upimg" style="display:none" onchange="uploadImg(this)" accept = "image/*"/>
                            <input type="hidden" value="{{isset($userInfo->member_pic)?$userInfo->member_pic:null}}" name="upload_img" id="uploadImgPath">
                            <div id="uploadImg"></div>
                        </li>
                        <li>
                            <label class="user_title_name">真实姓名：</label>
                            <input name="member_name" type="text"  class="add_text" value="{{isset($userInfo->member_name)?$userInfo->member_name:null}}"/>
                        </li>
                        <li>
                            <label class="user_title_name">用户性别：</label>
                            <label class="sex"> <input type="radio" name="member_sex" value="0" id="RadioGroup1_0" {{isset($userInfo->member_sex)&&$userInfo->member_sex==0?'checked':null}}/><span>男</span></label>
                            <label class="sex"><input type="radio" name="member_sex" value="1" id="RadioGroup1_1"  {{isset($userInfo->member_sex)&&$userInfo->member_sex==1?'checked':null}}/><span>女</span></label>
                        </li>
                        <li>
                            <label class="user_title_name">手 机 号：</label>
                            <input name="member_tel" type="text"  class="add_text" value="{{isset($userInfo->member_tel)?$userInfo->member_tel:null}}"/>
                        </li>
                        <li>
                            <label class="user_title_name">&nbsp;生  日：</label>
                            <input name="member_birth" type="text"  class="add_text" id="datepicker" autocomplete="off" value="{{isset($userInfo->member_birth)?date('Y/m/d' , $userInfo->member_birth):null}}"/>
                            <script>
                                $(function() {
                                    $( "#datepicker" ).datepicker({
                                        changeMonth: true,
                                        changeYear: true
                                    });
                                });
                            </script>
                        </li>
                        <input type="hidden" name="users_id" value="{{Auth::id()}}"/>
                        <input type="hidden" name="blacklist" value="0"/>
                        <input type="hidden" name="vip" value="0"/>
                    </ul>
                    <div class="operating_btn">
                        <button name="up" type="submit" class="submit—btn">提&nbsp;&nbsp;&nbsp;交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection