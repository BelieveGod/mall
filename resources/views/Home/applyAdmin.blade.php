@extends('Home.common')

@section('common')
    <div class="call_Inside_pages clearfix" style='background-image: url("/image/home/call_us.jpg");
    background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%; margin-bottom: 100px;'>
        <div class="clearfix user" style="">
            <div class="call_user_right"style="background: rgba(255,255,255,0.6);">
                <div class="user_Borders" style="min-height: 450px">
                    <div class="title_name">
                        <span class="name">申请加入我们</span>
                        <a href="/admin/auth/login" style="float:right">我已是供应商了》</a>
                    </div>
                    <div class="about_user_info">
                        <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                            <div class="call_user_layout">
                                <ul style="width: 50% ;float: left">
                                    <li>
                                        <label class="user_title_name">商家昵称：</label>
                                        <input type="text" class="add_text" name="suggest_type" placeholder="请输入昵称"/>
                                    </li>
                                    <li>
                                        <label class="user_title_name">店铺名称：</label>
                                        <input type="text"  class="add_text" placeholder="请输入店铺名称" name="suggest_attr"/>
                                    </li>
                                    {{--<li>--}}
                                        {{--<label class="user_title_name">所属省份：</label>--}}
                                        {{--<input type="text"  class="add_text" placeholder="请输入省份" name="suggest_attr"/>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<label class="user_title_name">所属市：</label>--}}
                                        {{--<input type="text"  class="add_text" placeholder="请输入所属市" name="suggest_attr"/>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<label class="user_title_name">所属区/县：</label>--}}
                                        {{--<input type="text"  class="add_text" placeholder="请输入所属区/县" name="suggest_attr"/>--}}
                                    {{--</li>--}}
                                    <li>
                                        <label class="user_title_name">注册地址：</label>
                                        <input type="text"  class="add_text" placeholder="请输入注册的详细地址" name="suggest_attr"/>
                                    </li>

                                </ul>
                                <ul style="width: 50%; float: left">

                                    <li>
                                        <label class="user_title_name">注册实名：</label>
                                        <input type="text"  class="add_text" placeholder="请输入真实姓名" name="suggest_attr"/>
                                    </li>
                                    <li>
                                        <label class="user_title_name">注册电话：</label>
                                        <input type="text"  class="add_text" placeholder="请输入电话号码" name="suggest_attr"/>
                                    </li>
                                    <li>
                                        <label class="user_title_name">身份证号码：</label>
                                        <input type="text"  class="add_text" placeholder="请输入身份证号码" name="suggest_attr"/>
                                    </li>

                                    <li>
                                        <label class="user_title_name">邮政编码：</label>
                                        <input type="text"  class="add_text" placeholder="请输入邮政编码" name="suggest_attr"/>
                                    </li>
                                    <li>
                                        <label class="user_title_name">实名照片：</label>
                                        <input type="file"   name="suggest_attr"/>
                                    </li>
                                    <li>
                                        <label class="user_title_name"></label>
                                        <img src="/image/test/2.jpg" width="60" height="60"/>
                                        <img src="/image/test/2.jpg" width="60" height="60"/>
                                        <img src="/image/test/2.jpg" width="60" height="60"/>
                                    </li>

                                    {{--<li style="height: 100px">--}}
                                        {{--<label class="user_title_name">问题描述：</label>--}}
                                        {{--<textarea style="height: 100px;width: 400px; border: 1px solid #ddd; padding: 10px 10px;" name="text">具体问题描述</textarea>--}}
                                    {{--</li>--}}
                                    {{--<input type="hidden" name="user_id" value="{{Auth::id()}}"/>--}}

                                </ul>
                                <div class="operating_btn">
                                    <button name="up" type="submit" class="submit—btn">提&nbsp;&nbsp;&nbsp;交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--<div class="register_img"><img src="/image/home/Register_img.png" /></div>--}}
        </div>

    </div>

@endsection