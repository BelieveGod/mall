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
        <div class="title_name"><a href="groupBuy/2" class="link_name">最新促销</a></div>
        <div class="carouFredSel">
            <script type="text/javascript" src="./js/home/slider.js"></script>
            <div id="center">
                <div id="slider">
                    @foreach($ad_nd as $value)
                    <div class="slide">
                        <a href="{{isset($value['product_id'])?'/productDetailed/'.$value['product_id']:null}}" title="">
                            <img class="diapo" border="0" src="./uploads/{{$value['ad_img']}}" style="opacity: 1; visibility: visible;">
                        </a>
                        <div class="backgroundText_name" >
                            <div class="product_info">
                                <h2>{{$value['product']['product_name']}}</h2>
                                <h5>产地：{{$value['product']['product_origin']}}</h5>
                                <p>原价：<b>￥{{$value['product']['prime_cost']}}</b></p>
                            </div>
                            <div class="product_price">
                                <a href="{{isset($value['product_id'])?'/productDetailed/'.$value['product_id']:null}}" class="price_btn">
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
                <div class="list_title">
                    <ul>
                        <li><h3>01</h3><a href="/productList/2">水果</a></li>
                        <li><h3>02</h3><a href="/productList/3">蔬菜</a></li>
                        <li><h3>03</h3><a href="/productList/4">畜牧水产</a></li>
                        <li><h3>04</h3><a href="/productList/5">粮油</a></li>
                    </ul>
                </div>
            </div>

            <div class="bd">
                {{--<div class="fixed_title_name">--}}
                    {{--<span>新鲜</span>--}}
                {{--</div>--}}
                <ul class="">
                    <li class="advertising">
                        <div class="AD2">
                            @foreach($fruit as $value)
                            <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}"><img src="/uploads/{{isset($value['product_master_img'][0])?$value['product_master_img'][0]:null}}" /></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="advertising">
                        <div class="AD2">
                            @foreach($green as $value)
                                <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}"><img src="/uploads/{{isset($value['product_master_img'][0])?$value['product_master_img'][0]:null}}" /></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="advertising">
                        <div class="AD2">
                            @foreach($fish   as $value)
                                <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}"><img src="/uploads/{{isset($value['product_master_img'][0])?$value['product_master_img'][0]:null}}" /></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="advertising">
                        <div class="AD2">
                            @foreach($rice   as $value)
                                <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}"><img src="/uploads/{{isset($value['product_master_img'][0])?$value['product_master_img'][0]:null}}" /></a>
                            @endforeach
                        </div>
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
                @foreach($menu_list as $value)
                <a href="/productList/{{isset($value['category_id'])?$value['category_id']:null}}">{{isset($value['menu_name'])?$value['menu_name']:null}}</a>
                @endforeach
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
                        <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}"  title="{{$value['dec']}}">
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


