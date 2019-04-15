<!DOCTYPE>
<html>
<head>
    {{--{{asset('/resources/assets/home/css/css/bootstrap.css')}}--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="order by dede58.com"/>
    <link href="/css/home/css.css" rel="stylesheet" type="text/css" />
    <link href="/css/home/common.css" rel="stylesheet" type="text/css" />
    <link href="/css/home/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="/js/home/jquery.min.1.8.2.js" type="text/javascript"></script>
    <script src="/js/home/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/home/slider.js"></script>
    <script src="/js/home/common_js.js" type="text/javascript"></script>
    <script src="/js/home/jquery.foucs.js" type="text/javascript"></script>
    {{--<link rel="stylesheet" href="./css/home/font-awesome-ie7.min.css">--}}
    <title></title>
</head>

<body>
<!--顶部样式-->
<div class="top_header">
    <em class="left_img"></em>
    <div class="header clearfix" id="header">
        <a href="/home_index" class="logo_img"><img src="" style="width: 375px;height: 95px"/></a>
        <div class="header_Section" style="width: 760px;">
            <div class="shortcut">
                <ul>
                    @guest
                        <li  class="hd_menu_tit"><em class="login_img"></em><a href="/login">登录</a></li>
                        <li  class="hd_menu_tit"><em  class="registered_img"></em><a href="/register">注册</a></li>
                    @else
                        <li  class="hd_menu_tit" >
                            <em class="login_img" id="top_cullom_user_id" attr="{{ Auth::user()->id }}"></em>
                            <a href="" >{{ Auth::user()->name }}，您好！</a>
                        </li>
                        <li class="hd_menu_tit">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                退出
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    @endguest
                    <li  class="hd_menu_tit"><em class="Collect_img"></em><a href="/userCollect">收藏夹</a></li>
                    <li  class="hd_menu_tit"><em class="cart_img"></em><a href="/shoppingCart">购物车（0）</a></li>
                    {{--<li  class="hd_menu_tit list_name" data-addclass="hd_menu_hover"><a href="#">网站导航</a><em class="navigation_img"></em>--}}

                    {{--<div class="hd_menu_list">--}}
                    {{--<span class="wire"></span>--}}
                    {{--<ul>--}}
                    {{--<li><a href="#">常见问题</a></li>--}}
                    {{--<li><a href="#">在线退换货</a></li>--}}
                    {{--<li><a href="#">在线投诉</a></li>--}}
                    {{--<li><a href="#">配送范围</a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--</li>--}}
                </ul>
            </div>
            <div id="msg">已成功加入购物车！</div>
            <div class="nav" id="Navigation">
                <ul class="Navigation_name">
                    <li class=""><a href="/home_index">首页</a></li>
                    <li class=""><a href="/product">所有商品</a></li>
                    <li class=""><a href="/groupBuy">活动专区</a></li>
                    <li class=""><a href="">文章话题</a></li>
                    <li class=""><a href="/user_index">会员中心</a></li>
                    <li class=""><a href="/applyAdmin">我要供应</a></li>
                    <li class=""><a href="/callAboutUs">联系我们</a></li>
                </ul>
            </div>
            <script>
                // $("#Navigation").slide({titCell:".Navigation_name li"});
                $('#Navigation').find('li').each(function () {
                    $(this).on('mouseover' , function () {
                        $('#Navigation').find('.on').removeClass('on');
                        $(this).addClass('on');
                    });
                    $(this).on('mouseout' , function () {
                        $('#Navigation').find('.on').removeClass('on');
                    });
                });
            </script>
        </div>
    </div>
    <em class="right_img"></em>
</div>
@yield('common')
<!--底部样式-->
<div class="footer">
    <div class="footer_img_bg"></div>
    <div class="footerbox">
        <div class="footer_info">
            <div class="footer_left">
                <a href="#"><img src="" /></a>
                <p class="erwm">
                    <img src=""  width="80px" height="80px"/>
                    <img src=""  width="80px" height="80px"/>
                <p>
            </div>
            <div class="helper_right clearfix">
                <dl>
                    <dt><em class="guide"></em>新手指南</dt>
                    <dd><a href="#">注册新用户</a></dd>
                    <dd><a href="#">实名认证</a></dd>
                    <dd><a href="#">找回密码</a></dd>
                </dl>
                <dl>
                    <dt ><em class="h_about"></em>关于我们</dt>
                    <dd><a href="#">关于我们</a></dd>
                    <dd><a href="#">政策服务</a></dd>
                    <dd><a href="#">常见问题</a></dd>
                </dl>
                <dl>
                    <dt ><em class="h_conact"></em>联系我们</dt>
                    <dd><a href="#">联系我们</a></dd>
                    <dd><a href="#">在线客服</a></dd>
                </dl>
            </div>
        </div>
    </div>
    <div class=" Copyright">

    </div>
</div>
</body>
</html>