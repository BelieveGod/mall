@extends('Home.common')

@section('common')
<!--导航-->
<div class="Bread_crumbs pro_crumbs" style="background: #70b701 ; color: #fff">
    <div class="Inside_pages clearfix">
        <div class="left">
            <ul>
                <li><a href="/productList/2">新鲜水果</a></li>
                <li><a href="/productList/3">有机蔬菜</a></li>
                <li><a href="/productList/4">畜牧水产</a></li>
                <li><a href="/productList/5">粮油米面</a></li>
                <li><a href="/productList/6">农副加工</a></li>
                <li><a href="/productList/7">苗木花草</a></li>
                <li><a href="/productList/8">农资农机</a></li>
                <li><a href="/productList/9">种子种苗</a></li>
            </ul>
        </div>
    </div>
</div>
<!--位置-->
<div class="Bread_crumbs">
    <div class="Inside_pages clearfix">
        <div class="left">当前位置：<a href="#">首页</a>&gt;<a href="#">素菜馆</a></div>
        <div class="right Search">
            <form>
                <input name="" type="text"  class="Search_Box"/>
                <input name="" type="button"  name="" class="Search_btn"/>
            </form>
        </div>
    </div>
</div>
<!--商品详细介绍-->
<div class="Inside_pages clearfix">
    <div class="left_style">
        <div class="title_img_p" style="font-size: 30px;color: #fff;text-align: center;line-height: 140px;">今日推荐</div>
        <div class="ranking">
            <div class="ranking_title"><span>销量</span>排行</div>
            <ul class="ranking_list">
                @foreach($topProduct as $key=>$value)
                <li class="">
                    <em class="ranking_label">{{$key+1}}</em>
                    <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}" class="img"> <img src="/uploads/{{isset($value['product_master_img'][0])?$value['product_master_img'][0]:null}}" width="100px" height="100px" /></a>
                    <p class="ranking_name">{{isset($value['product_name'])?$value['product_name']:null}}</p>
                    <p class="price"><b>￥</b>{{isset($value['present_price'])?$value['present_price']:null}}</p>
                    <p><a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}">立即查看 》</a></p>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--详细介绍样式-->
    <div class="right_style">
        <div class="pro_detailed">
            <div class="Details_style clearfix" id="goodsInfo" style="position: relative">
                <div class="mod_picfold clearfix">
                    <div class="clearfix" id="detail_main_img">
                        <div class="layout_wrap da">
                            <!--相册样式-->
                            <div class="shang">
                                <img src="/uploads/{{isset($product['product_master_img'][0])?$product['product_master_img'][0]:null}}" height="400" width="400" id="pian">
                                <p class="yin"></p>
                            </div>
                            <p class="bao">
                                <span class="zuo"></span>
                                <div class="tab">
                                    <ul class="Ul">
                                        @foreach($product['product_master_img'] as $value)
                                        <li style="width: 50px;">
                                            <img src="/uploads/{{isset($value)?$value:null}}" height="52" width="52" />
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            <span class="you"></span>
                        </div>
                        <script>
                            $(function(){
                                var $yin = $(".yin");
                                $(".Ul li img").mouseover(function(){
                                    $(this).parent().addClass("li").siblings().removeClass("li");
                                    $("#pian").attr("src",$(this).attr("src"));
                                    $("#zhao").attr("src",$(this).attr("src"));
                                }).mouseout(function(){
                                    $(this).parent().removeClass("li");
                                });
                                var l = $(".shang").eq(0).offset().left;
                                var t = $(".shang").eq(0).offset().top;
                                var width1 = $(".yin").outerWidth()/2;
                                var height1 = $(".yin").outerHeight()/2;
                                var maxL = $(".shang").width() - $yin.outerWidth();
                                var maxT = $(".shang").height() - $yin.outerHeight();
                                var bili = $("#zhao").width()/$("#pian").width();
                                $(".shang").mousemove(function(e){
                                    var maskL = e.clientX - l - width1,maskT = e.clientY - t - height1;
                                    if (maskL < 0) { maskL = 0};
                                    if (maskT < 0) { maskT = 0};
                                    if (maskL > maxL) {maskL = maxL};
                                    if (maskT > maxT) {maskT = maxT};
                                    $yin.css({"left":maskL,"top":maskT});
                                    $(".xia").show();
                                    $(".yin").show();
                                    $("#zhao").css({"margin-left":-maskL*bili,"margin-top":-maskT*bili});
                                });
                                $(".shang").mouseleave(function(){
                                    $(".xia").hide();
                                    $(".yin").hide();
                                });
                                var marginLeft = 0;
                                $(".you").click(function(){
                                    marginLeft = marginLeft - 64;
                                    if (marginLeft < -192) {marginLeft = -192};
                                    $(".tab ul").stop().animate({"margin-left":marginLeft},"fast");
                                });
                                $(".zuo").click(function(){
                                    marginLeft = marginLeft + 64;
                                    if (marginLeft > 0) {marginLeft = 0};
                                    $(".tab ul").stop().animate({"margin-left":marginLeft},"fast");
                                });
                                $(".lie li").click(function(){
                                    var index=$(this).index();
                                    $(this).addClass("ll").siblings().removeClass("ll");
                                    $(".bao1>p").eq(index).show().siblings().hide();
                                });
                            });
                        </script>
                    </div>
                    <div class="Sharing">
                        {{--<div class="bdsharebuttonbox right">--}}
                            {{--<a href="#" class="bds_more" data-cmd="more"></a>--}}
                            {{--<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>--}}
                            {{--<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>--}}
                            {{--<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>--}}
                            {{--<a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>--}}
                            {{--<a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>--}}
                        {{--</div>--}}

                        <!--收藏-->
                        <div class="coding">商品编码：3434534534534534</div>
                    </div>
                </div>
                <div class="xia">
                    {{--显示首图    --}}
                    <img src="/uploads/{{isset($product['product_master_img'][0])?$product['product_master_img'][0]:null}}" height="600" width="600" id="zhao" />
                </div>
                <!--购买信息-->
                <div class="Buying_info">
                    <div class="product_name"><h2>{{$product['product_name']}}</h2><span>产地：{{$product['product_origin']}}</span></div>
                    <div class="product_price">
                        <div class="price"><label>商城价：</label>￥234.00 <b>元/箱</b></div>
                        <div class="jyScore-fra"><span><em style="width:60px;"></em></span><b>4.5</b><a href="#">共有16条评论</a></div>
                    </div>
                    <div class="productDL">
                        <dl><dt>品种：</dt><dd class="left"><div class="item  selected"><b></b><a href="#none" title="金晕">芹川</a></div> <div class="item"><b></b><a href="#none" title="芹川">芹川</a></div></dd></dl>
                        <dl><dt>包装：</dt><dd class="left">
                                <div class="item  selected"><b></b><a href="#none" title="小礼盒">小礼盒</a></div>
                                <div class="item"><b></b><a href="#none" title="普通包装">普通包装</a></div>
                                <div class="item"><b></b><a href="#none" title="大礼盒">大礼盒</a></div></dd></dl>
                        <dl><dt>数量：</dt><dd class="left">
                                <div class="Numbers">
                                    <a href="javascript:void(0);" onclick="updatenum('del');" class="jian  ">-</a>
                                    <input id="number" name="number" type="text" value="1" class="number_text">
                                    <a href="javascript:void(0);" onclick="updatenum('del');" class="jia  ">+</a>
                                </div>
                            </dd><dd class="left Quantity">(库存：30000)</dd></dl>
                    </div>
                    <div class="product_Quantity">销量：3440</div>
                    <div class="operating">
                        <a href="#" class="buy_btn"></a>
                        <a href="#" class="Join_btn"></a>
                        <a href="#" class="Collect_btn"></a>
                    </div>
                </div>
            </div>
            <!--信息展示-->
            <div class="mainListRight ">
                <ul class="fixed_bar " style="">
                    <li class="status_on active" onclick="status1()"><a>产品介绍</a></li>
                    <li class="status_on" onclick="status2()"><a>商品评价<span>(100)</span></a></li>
                    <li class="status_on" onclick="status3()"><a>售后服务</a></li>
                    <div class="statusBtn" style="display: none;"><a href="javascript:addToCart_bak(77)" class="statusBtn1" title="加入购物车"></a></div>
                </ul>
            </div>
            <script>
                function status1(){
                    $('#status2').css('display' , 'none');
                    $('#shbz').css('display' , 'none');
                    $('#status1').css('display' , 'block');
                }
                function status2(){
                    $('#status1').css('display' , 'none');
                    $('#shbz').css('display' , 'none');
                    $('#status2').css('display' , 'block');
                }
                function status3(){
                    $('#status1').css('display' , 'none');
                    $('#status2').css('display' , 'none');
                    $('#shbz').css('display' , 'block');
                }

                $(function(){
                    $('.tab-con').find('.comment-item').each(function(){
                        $(this).find('.pic-list').find('a').each(function(){
                            $(this).click(function(){
                                var src = $(this).find('img').attr('src');
                                // alert(src);
                                $(this).parent().find('a').removeClass('current');
                                $(this).addClass('current');
                                $(this).parent().next().css('display' , 'block');
                                $(this).parent().next().find('img').attr('src' , src);

                            });
                        });
                    });
                });

            </script>

            <!-- 下面的产品说明部分 -->
            {{--产品介绍--}}
            <div class="about_product_status1"  style="display: block" id="status1">
                {!!$product['product_detail']!!}
            </div>

            {{--商品评价--}}
            <div class="about_product_status2" id="status2" style="display: none">
                <div class="comment-info">
                    <div class="comment-percent">
                        <strong class="percent-tit">好评度</strong>
                        <div class="percent-con">99<span>%</span></div>
                    </div>
                    <div class="percent-info">
                        <div class="tag-list ">
                            <span>好评（99）</span>
                            <span>中评（0）</span>
                            <span>差评（1）</span>
                        </div>
                    </div>
                </div>
                <div class="tab-main small">
                    <ul class="filter-list">
                        <li style="width: 120px;">
                            <a href="">全部评论（1000）</a>
                        </li>
                        <li style="width: 100px;">
                            <a href="">好评（1000）</a>
                        </li>
                        <li style="width: 100px;">
                            <a href="">中评（1000）</a>
                        </li>
                        <li style="width: 100px;">
                            <a href="">差评（1000）</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-con">
                    <div class="comment-item">
                        <div class="user-column">
                            <div class="user-info">
                                <img src="/image/test/2.jpg" width="30" height="30"/>陈*迅
                            </div>
                            <div class="user-level">
                                <span style="color: rgb(136,136,136);"></span>
                            </div>
                        </div>
                        <div class="comment-column J-comment-column">
                            <div class="comment-star star5"></div>
                            <p class="comment-con">
                                昨晚拍的商品，今天上午快递就送到了，京东物流的确给力！东西刚刚收到，包装完好，就是奶粉的日期是去年2016年12月份生产的，没有防伪辨识卡，小孩还没有喝，等喝了再评价。
                            </p>
                            <div class="pic-list">
                                <a class="J-thumb-img">
                                    <img src="/image/test/1.jpg" width="48" height="48"/>
                                </a>
                                <a class="J-thumb-img">
                                    <img src="/image/test/2.jpg" width="48" height="48"/>
                                </a>
                                <a class="J-thumb-img">
                                    <img src="/image/test/1.jpg" width="48" height="48"/>
                                </a>
                            </div>
                            <div class="cursor-small" style="display: none">
                                <img src="/image/test/1.jpg" width="50%" />
                            </div>
                            <div class="comment-message">
                                <div class="order-info">
                                    <span>2019-3-28 15:53:01</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-item">
                        <div class="user-column">
                            <div class="user-info">
                                <img src="/image/test/2.jpg" width="30" height="30"/>陈*迅
                            </div>
                            <div class="user-level">
                                <span style="color: rgb(136,136,136);"></span>
                            </div>
                        </div>
                        <div class="comment-column J-comment-column">
                            <div class="comment-star star5"></div>
                            <p class="comment-con">
                                昨晚拍的商品，今天上午快递就送到了，京东物流的确给力！东西刚刚收到，包装完好，就是奶粉的日期是去年2016年12月份生产的，没有防伪辨识卡，小孩还没有喝，等喝了再评价。
                            </p>
                            <div class="pic-list">
                                {{--<a href="" class="J-thumb-img current">--}}
                                    {{--<img src="/image/test/1.jpg" width="48" height="48"/>--}}
                                {{--</a>--}}
                                {{--<a href="" class="J-thumb-img">--}}
                                    {{--<img src="/image/test/1.jpg" width="48" height="48"/>--}}
                                {{--</a>--}}
                                {{--<a href="" class="J-thumb-img">--}}
                                    {{--<img src="/image/test/1.jpg" width="48" height="48"/>--}}
                                {{--</a>--}}
                            </div>
                            <div class="cursor-small">
                                {{--<img src="/image/test/1.jpg" width="50%" />--}}
                            </div>
                            <div class="comment-message">
                                <div class="order-info">
                                    <span>2019-3-28 15:53:01</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-item">
                        <div class="user-column">
                            <div class="user-info">
                                <img src="/image/test/2.jpg" width="30" height="30"/>陈*迅
                            </div>
                            <div class="user-level">
                                <span style="color: rgb(136,136,136);"></span>
                            </div>
                        </div>
                        <div class="comment-column J-comment-column">
                            <div class="comment-star star5"></div>
                            <p class="comment-con">
                                昨晚拍的商品，今天上午快递就送到了，京东物流的确给力！东西刚刚收到，包装完好，就是奶粉的日期是去年2016年12月份生产的，没有防伪辨识卡，小孩还没有喝，等喝了再评价。
                            </p>
                            <div class="pic-list">
                                <a class="J-thumb-img">
                                    <img src="/image/test/2.jpg" width="48" height="48"/>
                                </a>
                                <a class="J-thumb-img">
                                    <img src="/image/test/1.jpg" width="48" height="48"/>
                                </a>
                                <a class="J-thumb-img">
                                    <img src="/image/test/1.jpg" width="48" height="48"/>
                                </a>
                            </div>
                            <div class="cursor-small"style="display: none">
                                <img src="/image/test/2.jpg" width="50%" />
                            </div>
                            <div class="comment-message">
                                <div class="order-info">
                                    <span>2019-3-28 15:53:01</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-item">
                        <div class="user-column">
                            <div class="user-info">
                                <img src="/image/test/2.jpg" width="30" height="30"/>陈*迅
                            </div>
                            <div class="user-level">
                                <span style="color: rgb(136,136,136);"></span>
                            </div>
                        </div>
                        <div class="comment-column J-comment-column">
                            <div class="comment-star star5"></div>
                            <p class="comment-con">
                                昨晚拍的商品，今天上午快递就送到了，京东物流的确给力！东西刚刚收到，包装完好，就是奶粉的日期是去年2016年12月份生产的，没有防伪辨识卡，小孩还没有喝，等喝了再评价。
                            </p>
                            <div class="pic-list">
                                <a class="J-thumb-img">
                                    <img src="/image/test/1.jpg" width="48" height="48"/>
                                </a>
                                <a class="J-thumb-img">
                                    <img src="/image/test/1.jpg" width="48" height="48"/>
                                </a>
                                <a class="J-thumb-img">
                                    <img src="/image/test/1.jpg" width="48" height="48"/>
                                </a>
                            </div>
                            <div class="cursor-small" style="display: none">
                                <img src="/image/test/1.jpg" width="50%" />
                            </div>
                            <div class="comment-message">
                                <div class="order-info">
                                    <span>2019-3-28 15:53:01</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 售后服务 --}}
            <div class="about_product_status1" id="shbz" style="display: none">
                <p> 在线交易:</p>
                <p>在线交易是手机惠农提供的买卖双方不见面也能完成交易的一种方式。</p>
                <p> 基地直供:</p>
                <p>供应商是果园基地种植户，不经中间商直接发货</p>
            </div>
        </div>
    </div>
</div>
@endsection