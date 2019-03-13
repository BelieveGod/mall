@extends('Home.common')

@section('common')
<!--用户中心-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
<script src="./js/home/home.js"></script>
<div class="Inside_pages clearfix">
    <div class="clearfix user" >
        <div class="user_left">
            <div class="user_info">
                <div class="Head_portrait"><img src="images/product_img_17.png"  width="80px" height="80px"/><!--头像区域--></div>
                <div class="user_name">用户蜜甘草<a href="#">[个人资料]</a></div>
            </div>
            <ul class="Section" id="Section_info">
                <li><a href="/userInfo"><em></em><span>个人信息</span></a></li>
                <li><a href="#"><em></em><span>修改密码</span></a></li>
                <li><a href="#"><em></em><span>我的订单</span></a></li>
                <li><a href="#"><em></em><span>我的评论</span></a></li>
                <li><a href="#"><em></em><span>我的积分</span></a></li>
                <li><a href="#"><em></em><span>我的收藏</span></a></li>
                <li><a href="#"><em></em><span>收货地址管理</span></a></li>
            </ul>
        </div>
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
                                    <label for="upimg" ><img src="./image/test/5.jpg" width="50px" /></label>
                                    <input name="member_pic" type="file" id="upimg" style="display:none" onchange="uploadImg(this)"/>
                                    <div id="uploadImg"></div>
                                </li>
                                <li>
                                    <label class="user_title_name">真实姓名：</label>
                                    <input name="member_name" type="text"  class="add_text"/>
                                </li>
                                <li>
                                    <label class="user_title_name">用户性别：</label>
                                    <label class="sex"> <input type="radio" name="member_sex" value="0" id="RadioGroup1_0" /><span>男</span></label>
                                    <label class="sex"><input type="radio" name="member_sex" value="1" id="RadioGroup1_1" /><span>女</span></label>
                                </li>
                                <li>
                                    <label class="user_title_name">手 机 号：</label>
                                    <input name="member_tel" type="text"  class="add_text"/>
                                </li>
                                <li>
                                    <label class="user_title_name">&nbsp;生  日：</label>
                                    <input name="member_birth" type="text"  class="add_text" id="datepicker" autocomplete="off"/>
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
                                <button name="up" type="submit" class="submit—btn">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection