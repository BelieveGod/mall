@extends('Home.common')

@section('common')
    <!--搜索-->
    <div class="Bread_crumbs pro_crumbs" style="background: #70b701 ; color: #fff">
        <div class="Inside_pages clearfix">
            <div class="left">
                <ul>
                    <li><a href="">新鲜水果</a></li>
                    <li><a href="#vertable">有机蔬菜</a></li>
                    <li><a href="#chicken">畜牧水产</a></li>
                    <li><a href="#rice">粮油米面</a></li>
                    <li><a href="#jiagong">农副加工</a></li>
                    <li><a href="#flower">苗木花草</a></li>
                    <li><a href="#nongzi">农资农机</a></li>
                    <li><a href="#seed">种子种苗</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--位置-->
    <div >
        <div class="Bread_crumbs">
            <div class="Inside_pages clearfix">
                <div class="left">当前位置：<a href="/home_index">首页</a>&gt;<a href="/product">所有商品</a>&gt;<a href="#">素菜馆</a></div>
                <div class="right Search">
                    <form>
                        <input name="" type="text"  class="Search_Box"/>
                        <input name="" type="button"  name="" class="Search_btn"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--产品列表-->
    <div class="Inside_pages clearfix">
        <div class="margintop">
            <DIV class="left_style banner" style="z-index: 999;">
                <div class="ranking">
                    <ul class="con_list">
                        <li>
                            <div>核果仁果类<span>▼</span></div>
                            <ul class="con_list_child">
                                <li><a href="">核果</a></li>
                                <li><a href="">核果仁果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果仁果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                            </ul>
                        </li>
                        <li>
                            <div>核果仁果类<span>▼</span></div>
                            <ul class="con_list_child">
                                <li><a href="">核果</a></li>
                                <li><a href="">核果仁果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果仁果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                            </ul>
                        </li>
                        <li>
                            <div>核果仁果类<span>▼</span></div>
                            <ul class="con_list_child">
                                <li><a href="">核果</a></li>
                                <li><a href="">核果仁果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果仁果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                            </ul>
                        </li>
                        <li>
                            <div>核果仁果类<span>▼</span></div>
                            <ul class="con_list_child">
                                <li><a href="">核果</a></li>
                                <li><a href="">核果仁果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果仁果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                                <li><a href="">核果</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </DIV>
            <script>
                $(function(){
                    var banOffTop=$(".banner").offset().top;//获取到距离顶部的垂直距离
                    var scTop=0;//初始化垂直滚动的距离
                    $(document).scroll(function(){
                        scTop=$(this).scrollTop();//获取到滚动条拉动的距离
                        // console.log(scTop);
                        if(scTop>=banOffTop){
                            $(".banner").addClass("fixDiv");
                        }else{
                            $(".banner").removeClass("fixDiv");
                        }

                    })
                })

                $('.con_list').find('li').each(function () {
                    $(this).click(function(){
                        $('.con_list').find('ul').stop().slideUp(500);
                        $(this).find('ul').stop().slideToggle(500);
                    });
                });
            </script>

            {{--<DIV class="left_style">--}}
            {{--<div class="title_img_p">--}}
            {{--<span style="font-size: 28px;color: #fff;line-height: 140px;margin-left: 25%">蔬菜推荐</span>--}}
            {{--</div>--}}
            {{--<div class="ranking">--}}
            {{--<div class="ranking_title"><span>销量</span>排行</div>--}}
            {{--<ul class="ranking_list">--}}
            {{--<li class="">--}}
            {{--<em class="ranking_label">1</em>--}}
            {{--<a href="#" class="img"> <img src="/image/test/2.jpg" width="100px" height="100px" /></a>--}}
            {{--<p class="ranking_name">浦江特产绿豌豆天然无污染</p>--}}
            {{--<p class="price"><b>￥</b>12.54</p>--}}
            {{--<p><a href="#">立即查看< </a></p>--}}
            {{--</li>--}}
            {{--<li class="">--}}
            {{--<em class="ranking_label">2</em>--}}
            {{--<a href="#" class="img"> <img src="/image/test/2.jpg" width="100px" height="100px" /></a>--}}
            {{--<p class="ranking_name">浦江特产绿豌豆天然无污染</p>--}}
            {{--<p class="price"><b>￥</b>12.54</p>--}}
            {{--<p><a href="#">立即查看< </a></p>--}}
            {{--</li><li class="">--}}
            {{--<em class="ranking_label">3</em>--}}
            {{--<a href="#" class="img"> <img src="/image/test/2.jpg" width="100px" height="100px" /></a>--}}
            {{--<p class="ranking_name">浦江特产绿豌豆天然无污染</p>--}}
            {{--<p class="price"><b>￥</b>12.54</p>--}}
            {{--<p><a href="#">立即查看< </a></p>--}}
            {{--</li><li class="">--}}
            {{--<em class="ranking_label">4</em>--}}
            {{--<a href="#" class="img"> <img src="/image/test/2.jpg" width="100px" height="100px" /></a>--}}
            {{--<p class="ranking_name">浦江特产绿豌豆天然无污染</p>--}}
            {{--<p class="price"><b>￥</b>12.54</p>--}}
            {{--<p><a href="#">立即查看< </a></p>--}}
            {{--</li><li class="">--}}
            {{--<em class="ranking_label">5</em>--}}
            {{--<a href="#" class="img"> <img src="/image/test/2.jpg" width="100px" height="100px" /></a>--}}
            {{--<p class="ranking_name">浦江特产绿豌豆天然无污染</p>--}}
            {{--<p class="price"><b>￥</b>12.54</p>--}}
            {{--<p><a href="#">立即查看< </a></p>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</DIV>--}}
            <DIV class="right_style">
                <ul class="list_style">
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#" class="Collect"></a>
                            <a href="#"><img src="/image/test/2.jpg"  width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><del class="del_old_price">￥20</del><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#" class="Collect"></a>
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#" class="Collect"></a>
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#" class="Collect"></a>
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#" class="Collect"></a>
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="#"><img src="/image/test/2.jpg" width="210px" height="215px"/></a>
                            <p class="title_p_name">浦江多汁红提</p>
                            <p class="title_Profile">绿色有机天然无污染</p>
                            <p class="price"><b>￥</b>13.5</p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                </ul>
                <!--分页-->
                <div class="productList_pages_Collect clearfix">
                    <a href="#" class="on">《</a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">》</a>
                </div>
            </DIV>
        </div>
    </div>
@endsection