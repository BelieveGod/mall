@extends('Home.common')

@section('common')
    <!--用户中心-->
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    {{--<link rel="stylesheet" href="jqueryui/style.css">--}}

    <script src="./js/home/home.js"></script>
    <div class="Inside_pages clearfix">
        <div class="clearfix user" >
            <div class="user_left">
                <div class="user_info">
                    <div class="Head_portrait">
                        <!--头像区域-->
                        <img src="{{isset($userInfo->member_pic)?$userInfo->member_pic:'./image/test/5.jpg'}}" style="border-radius: 40px" width="80px" height="80px"/>
                    </div>
                    <div class="user_name">{{Auth::user()->name}}</div>
                </div>
                <ul class="Section" id="Section_info">
                    <li><a href="/userInfo"><em></em><span>个人信息</span></a></li>
                    <li><a href="/resetPassword"><em></em><span>修改密码</span></a></li>
                    <li><a href="#"><em></em><span>我的订单</span></a></li>
                    <li><a href="#"><em></em><span>我的评论</span></a></li>
                    <li><a href="#"><em></em><span>我的积分</span></a></li>
                    <li><a href="#"><em></em><span>我的收藏</span></a></li>
                    <li><a href="#"><em></em><span>收货地址管理</span></a></li>
                </ul>
            </div>

            @yield('info')

        </div>
    </div>

@endsection