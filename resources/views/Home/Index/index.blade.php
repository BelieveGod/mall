<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="order by dede58.com"/>
    <link href="./css/home/css.css" rel="stylesheet" type="text/css" />
    <link href="./css/home/common.css" rel="stylesheet" type="text/css" />
    <link href="./css/home/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="./js/home/jquery.min.1.8.2.js" type="text/javascript"></script>
    <script src="./js/home/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="./js/home/slide.js"></script>
    <script src="./js/home/common_js.js" type="text/javascript"></script>
    <script src="./js/home/jquery.foucs.js" type="text/javascript"></script>
    {{--<link rel="stylesheet" href="./css/home/font-awesome-ie7.min.css">--}}
    <title></title>
</head>

<body>
<!--顶部样式-->
<div class="top_header">
    <em class="left_img"></em>
    <div class="header clearfix" id="header">
        <a href="#" class="logo_img"><img src="images/logo.png" /></a>
        <div class="header_Section">
            <div class="shortcut">
                <ul>
                    <li  class="hd_menu_tit"><em class="login_img"></em><a href="#">登录</a></li>
                    <li  class="hd_menu_tit"><em  class="registered_img"></em><a href="#">注册</a></li>
                    <li  class="hd_menu_tit"><em class="Collect_img"></em><a href="#">收藏夹</a></li>
                    <li  class="hd_menu_tit"><em class="cart_img"></em><a href="#">购物车（0）</a></li>
                    <li  class="hd_menu_tit list_name" data-addclass="hd_menu_hover"><a href="#">网站导航</a><em class="navigation_img"></em>

                        <div class="hd_menu_list">
                            <span class="wire"></span>
                            <ul>
                                <li><a href="#">常见问题</a></li>
                                <li><a href="#">在线退换货</a></li>
                                <li><a href="#">在线投诉</a></li>
                                <li><a href="#">配送范围</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="nav" id="Navigation">
                <ul class="Navigation_name">
                    @foreach($menu as $value)
                    <li class=""><a herf="">{{$value->menu_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
        </div>
    </div>
    <em class="right_img"></em>
</div>
<!--幻灯片效果-->
<div class="AD_bg_img">
    <div class="slider">
        <div id="slideBox" class="slideBox">
            <div class="hd">
                <ul></ul>
            </div>
            <div class="bd">
                <ul>
                    <li><a href="#" target="_blank"><img src="./image/test/1.jpg" /></a></li>
                    <li><a href="#" target="_blank"><img src="./image/test/2.jpg" /></a></li>
                    <li><a href="#" target="_blank"><img src="./image/test/3.jpg" /></a></li>
                </ul>
            </div>
            <a class="prev" href="javascript:void(0)"></a>
            <a class="next" href="javascript:void(0)"></a>
        </div>
        <!--添加定时器-->
        <script type="text/javascript">
            jQuery(".slideBox").slide({
                titCell:".hd ul",
                mainCell:".bd ul",
                autoPlay:true,
                autoPage:true,
                interTime:5000,
            });
        </script>
    </div>
</div>

<!--手风琴效果-->
<div class="recommend_style ">
    <em class="ye_img"></em>
    <div class="mian">
        <div class="title_name"><a href="#" class="link_name">最新促销</a></div>
        <div class="carouFredSel">
            <script type="text/javascript" src="./js/home/slider.js"></script>
            <div id="center">
                <div id="slider">
                    <div class="slide">
                        <a href="#" title="" target="_blank">
                            <img class="diapo" border="0" src="./image/test/1.jpg" style="opacity: 1; visibility: visible;">
                        </a>
                        <div class="backgroundText_name" >
                            <div class="product_info">
                                <h2>杨千fa</h2>
                                <h5>产地：</h5>
                                <p>原价：<b>￥</b></p>
                            </div>
                            <div class="product_price">
                                <a href="#" class="price_btn">
                                    <p class="left_title_p"></p>
                                    <p class="zj_bf"><em>￥</em>29.90</p>
                                    <p class="right_buf"></p>
                                </a>
                            </div>
                        </div>
                        <div class="text"></div>
                    </div>
                    <div class="slide" >
                        <a href="#" title="" target="_blank">
                            <img class="diapo" border="0" src="./image/test/2.jpg" style="opacity: 0.7; visibility: visible;">
                        </a>
                        <div class="backgroundText_name" >
                            <div class="product_info">
                                <h2>陈医生</h2>
                                <h5>产地：</h5>
                                <p>原价：<b>￥</b></p>
                            </div>
                            <div class="product_price">
                                <a href="#" class="price_btn">
                                    <p class="left_title_p"></p>
                                    <p class="zj_bf"><em>￥</em>29.90</p>
                                    <p class="right_buf"></p>
                                </a>
                            </div>
                        </div>
                        <div class="text"></div>
                    </div>
                    <div class="slide" >
                        <a href="#" title="" target="_blank">
                            <img class="diapo" border="0" src="./image/test/1.jpg" style="opacity: 0.7; visibility: visible;">
                        </a>
                        <div class="backgroundText_name" >
                            <div class="product_info">
                                <h2>杨千fa</h2>
                                <h5>产地：</h5>
                                <p>原价：<b>￥</b></p>
                            </div>
                            <div class="product_price">
                                <a href="#" class="price_btn">
                                    <p class="left_title_p"></p>
                                    <p class="zj_bf"><em>￥</em>29.90</p>
                                    <p class="right_buf"></p>
                                </a>
                            </div>
                        </div>
                        <div class="text"></div>
                    </div>
                    <div class="slide">
                        <a href="#" title="豪宅别墅设计" target="_blank">
                            <img class="diapo" border="0" src="./image/test/2.jpg" style="opacity: 0.7; visibility: visible;">
                        </a>
                        <div class="backgroundText_name" >
                            <div class="product_info">
                                <h2>陈医生</h2>
                                <h5>产地：</h5>
                                <p>原价：<b>￥</b></p>
                            </div>
                            <div class="product_price">
                                <a href="#" class="price_btn">
                                    <p class="left_title_p"></p>
                                    <p class="zj_bf"><em>￥</em>29.90</p>
                                    <p class="right_buf"></p>
                                </a>
                            </div>
                        </div>
                        <div class="text"></div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                slider.init();
            </script>
        </div>
    </div>
    <em class="ye_img1"></em>
</div>
<!--最新上架产品样式-->
<div class="new_products clearfix">
    <div class="mian">
        <div id="slideBox_list" class="slideBox_list">
            <div class="hd">
                <div class="title_name"></div>
                <div class="list_title"><ul><li><h3>01</h3><a href="#">水果</a></li><li><h3>02</h3><a href="#">蔬菜</a></li><li><h3>03</h3><a href="#">干果</a></li><li><h3>04</h3><a href="#">其他</a></li></ul></div>
            </div>

            <div class="bd">
                <div class="fixed_title_name">
                    <span>新鲜</span>
                </div>
                <ul class="">
                    <li class="advertising">
                        <div class="AD1"><a href="#"><img src="./image/test/2.jpg" /></a></div>
                        <div class="AD2"><a href="#"><img src="./image/test/1.jpg" /></a><a href="#"><img src="./image/test/2.jpg" /></a></div>
                        <div class="AD3"><a href="#"><img src="./image/test/2.jpg" /></a></div>
                    </li>
                    <li class="advertising">
                        <div class="AD1"><a href="#"><img src="./image/test/2.jpg" /></a></div>
                        <div class="AD2"><a href="#"><img src="./image/test/2.jpg" /></a><a href="#"><img src="./image/test/1.jpg" /></a></div>
                        <div class="AD3"><a href="#"><img src="./image/test/1.jpg" /></a></div>
                    </li>
                    <li class="advertising">
                        <div class="AD1"><a href="#"><img src="./image/test/2.jpg" /></a></div>
                        <div class="AD2"><a href="#"><img src="./image/test/2.jpg" /></a><a href="#"><img src="./image/test/2.jpg" /></a></div>
                        <div class="AD3"><a href="#"><img src="./image/test/2.jpg" /></a></div>
                    </li>
                    <li class="advertising">
                        <div class="AD1"><a href="#"><img src="./image/test/2.jpg" /></a></div>
                        <div class="AD2"><a href="#"><img src="./image/test/2.jpg" /></a><a href="#"><img src="./image/test/2.jpg" /></a></div>
                        <div class="AD3"><a href="#"><img src="./image/test/1.jpg" /></a></div>
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">jQuery(".slideBox_list").slide({mainCell:".bd ul"});</script>
    </div>
</div>
<!--产品推荐样式-->
<div class="p_Slideshow">
    <div class="mian">
        <div class="title_style">
            <div class="title_img"></div>
            <div class="title_link_name">
                <a href="#">火龙果</a>
                <a href="#">香蕉</a>
                <a href="#">红心蜜柚</a>
                <a href="#">柠檬</a>
                <a href="#">火龙果</a>
                <a href="#">猕猴桃</a>
                <a href="#">红心蜜 </a>
                <a href="#">柠檬火龙果</a>
                <a href="#">西瓜 </a>
                <a href="#">红心蜜柚</a>
            </div>
        </div>
    </div> <!--幻灯片样式-->
    <div id="main">
        <div id="index_b_hero">
            <div class="title_img"></div>
            <div class="hero-wrap">
                <ul class="heros clearfix">
                    <li class="hero">
                        <a href="#" target="_blank" title="第一张图的说明">
                            <img src="./image/test/1.jpg" class="thumb" alt="" />
                        </a>
                        <div class="p_title_name">
                            <div class="p_recommend_info">
                                <h3>南岭荔枝水嫩香甜礼盒装</h3>
                                <p>新鲜包邮价：￥<b class="p_recommend_price">999</b>元</p>
                            </div>
                        </div>
                    </li>
                    <li class="hero">
                        <a href="#" target="_blank" title="第二张图的说明">
                            <img src="./image/test/2.jpg" class="thumb" alt="" />
                        </a>
                        <div class="p_title_name">
                            <div class="p_recommend_info">
                                <h3>南岭荔枝水嫩香甜礼盒装</h3>
                                <p>新鲜包邮价：￥<b class="p_recommend_price">999</b>元</p>
                            </div>
                        </div>
                    </li>
                    <li class="hero">
                        <a href="#" target="_blank" title="第三张图的说明">
                            <img src="./image/test/3.jpg" class="thumb" alt="" />
                        </a>
                        <div class="p_title_name">
                            <div class="p_recommend_info">
                                <h3>南岭荔枝水嫩香甜礼盒装</h3>
                                <p>新鲜包邮价：￥<b class="p_recommend_price">999</b>元</p>
                            </div>
                        </div>
                    </li>
                    {{--<li class="hero">--}}
                        {{--<a href="#" target="_blank" title="第4张图的说明">--}}
                            {{--<img src="./image/test/2.jpg" class="thumb" alt="" />--}}
                        {{--</a>--}}
                        {{--<div class="p_title_name">--}}
                            {{--<div class="p_recommend_info">--}}
                                {{--<h3>南岭荔枝水嫩香甜礼盒装</h3>--}}
                                {{--<p>新鲜包邮价：￥<b class="p_recommend_price">999</b>元</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                </ul>
            </div>
            <div class="helper">
                <div class="mask-left">
                </div>
                <div class="mask-right">
                </div>
                <a href="javascript:void(0)" class="prev icon-arrow-a-left"></a>
                <a href="#javascript:void(0)" class="next icon-arrow-a-right"></a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.foucs({ direction: 'right' });
    </script>
</div>
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
                @foreach($footer as $value)
                <dl>
                    <dt><em class="guide"></em>{{$value['parents']}}</dt>
                    @foreach($value['child'] as $val)
                    <dd><a href="#">{{$val}}</a></dd>
                    @endforeach
                </dl>
                @endforeach
            </div>
        </div>
    </div>
    <div class=" Copyright ">

    </div>
</div>
</body>
</html>
