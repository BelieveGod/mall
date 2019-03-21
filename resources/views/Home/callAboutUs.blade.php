@extends('Home.common')

@section('common')
<div class="call_Inside_pages clearfix" style='background-image: url("/image/test/4.jpg");
    background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%; margin-bottom: 50px;'>
    <div class="clearfix user" style="">
        <div class="call_user_right"style="background: rgba(255,255,255,0.6);">
            <div class="user_Borders" style="">
                <div class="title_name">
                    <span class="name">问题反馈</span>
                </div>
                <div class="about_user_info">
                    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                        <div class="call_user_layout">
                            <ul >
                                <li>
                                    <label class="user_title_name">反馈类型：</label>
                                    <select class="add_text">
                                        <option>请选择反馈类型</option>
                                        <option>问题</option>
                                        <option>建议</option>
                                    </select>
                                </li>
                                <li>
                                    <label class="user_title_name">所属分类：</label>
                                    <select class="add_text">
                                        <option>请选择分类</option>
                                        <option>举报商家</option>
                                        <option>举报用户</option>
                                    </select>
                                </li>
                                <li style="height: 100px">
                                    <label class="user_title_name">问题描述：</label>
                                    <textarea style="height: 100px;width: 400px; border: 1px solid #ddd; padding: 10px 10px;"> </textarea>
                                </li>
                                <input type="hidden" name="users_id" value="{{Auth::id()}}"/>

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