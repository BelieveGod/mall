@extends('Home.common')

@section('common')
<!--幻灯片效果-->
<div class="AD_bg_img">
    <div class="slider">
        <div id="slideBox" class="slideBox">
            <div class="hd">
                <ul></ul>
            </div>
            <div class="bd">
                <ul>
                    @foreach($ad_st as $value)
                    <li><a href="{{$value['http']}}" target="_blank"><img src="./uploads/{{$value['ad_img']}}" /></a></li>
                    @endforeach
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
                    @foreach($ad_nd as $value)
                    <div class="slide">
                        <a href="#" title="" target="_blank">
                            <img class="diapo" border="0" src="./uploads/{{$value['ad_img']}}" style="opacity: 1; visibility: visible;">
                        </a>
                        <div class="backgroundText_name" >
                            <div class="product_info">
                                <h2>{{$value['product']['product_name']}}</h2>
                                <h5>产地：{{$value['product']['product_origin']}}</h5>
                                <p>原价：<b>￥{{$value['product']['prime_cost']}}</b></p>
                            </div>
                            <div class="product_price">
                                <a href="#" class="price_btn">
                                    <p class="left_title_p"></p>
                                    <p class="zj_bf"><em>￥</em>{{$value['product']['present_price']}}</p>
                                    <p class="right_buf"></p>
                                </a>
                            </div>
                        </div>
                        <div class="text"></div>
                    </div>
                    @endforeach

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
                    @foreach($ad_rd as $value)
                    <li class="hero">
                        <a href="#" target="_blank" title="{{$value['dec']}}">
                            <img src="./uploads/{{$value['ad_img']}}" class="thumb" alt="" />
                        </a>
                        <div class="p_title_name">
                            <div class="p_recommend_info">
                                <h3>{{$value['product']['product_name']}}</h3>
                                <p>新鲜价：￥<b class="p_recommend_price">{{$value['product']['present_price']}}</b>元</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
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
@endsection


