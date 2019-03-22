@extends('Home.common')

@section('common')
<div class="call_Inside_pages clearfix" style='background-image: url("/image/home/call_us.jpg");
    background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%; margin-bottom: 100px;'>
    <div class="clearfix user" style="">
        <div class="call_user_right"style="background: rgba(255,255,255,0.6);">
            <div class="user_Borders" style="min-height: 450px">
                <div class="title_name">
                    <span class="name">问题反馈</span>
                    <a href="/mySuggest" style="float:right">我的建议》</a>
                </div>
                <div class="about_user_info">
                    <form id="form1" name="form1" method="post" action="/api/upSuggest" enctype="multipart/form-data">
                        <div class="call_user_layout">
                            <ul >
                                <li>
                                    <label class="user_title_name">反馈类型：</label>
                                    <select class="add_text" name="suggest_type">
                                        <option >请选择反馈类型</option>
                                        @foreach($suggestType as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <label class="user_title_name">相关说明：</label>
                                    <input type="text"  class="add_text" placeholder="请说明关于什么问题" name="suggest_attr"/>
                                </li>
                                <li style="height: 100px">
                                    <label class="user_title_name">问题描述：</label>
                                    <textarea style="height: 100px;width: 400px; border: 1px solid #ddd; padding: 10px 10px;" name="text">具体问题描述</textarea>
                                </li>
                                <input type="hidden" name="user_id" value="{{Auth::id()}}"/>

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