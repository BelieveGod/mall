@extends('Home.common')

@section('common')
<script src="/js/home/home.js" type="text/javascript"></script>
<div class="Narrow">
    <div class="shop_cart">
        <div class="schedule"></div>
        <div class="cart_style">
            <div class="title_name">
                <ul>
                    <li class="title_width"><label class="auto-label"><input type="checkbox" id="rememberMe"><span>全选</span></label></li>
                    <li class="title_width1">商品信息</li>
                    <li class="title_width2">单价</li>
                    <li class="title_width3">数量</li>
                    <li class="title_width4">小计</li>
                    <li class="title_width5">操作</li>
                </ul>
            </div>
            <div class="list_style">
                <div class="class_title">水果馆</div>
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="#" class="product_img left"><img src="/image/test/2.jpg" /></a>
                        <p class="cart_content">
                            <a href="#" class="title_name">浦江特产绿豌豆天然无污染</a>
                            <span> 礼盒装：20个装</span>
                        </p>
                    </li>
                    <li class="title_width2">￥23<span style="font-size: 12px">/斤</span></li>
                    <li class="title_width3">
                        <div class="Numbers">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="1" class="number_text">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥545</li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="#" class="product_img left"><img src="/image/test/2.jpg" /></a>
                        <p class="cart_content">
                            <a href="#" class="title_name">浦江特产绿豌豆天然无污染</a>
                            <span> 礼盒装：20个装</span>
                        </p>
                    </li>
                    <li class="title_width2">￥23<span style="font-size: 12px">/斤</span></li>
                    <li class="title_width3">
                        <div class="Numbers">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="1" class="number_text">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥545</li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
            </div>
            <div class="list_style">
                <div class="class_title">水果馆</div>
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="#" class="product_img left"><img src="/image/test/2.jpg" /></a>
                        <p class="cart_content">
                            <a href="#" class="title_name">浦江特产绿豌豆天然无污染</a>
                            <span> 礼盒装：20个装</span>
                        </p>
                    </li>
                    <li class="title_width2">￥23<span style="font-size: 12px">/斤</span></li>
                    <li class="title_width3">
                        <div class="Numbers">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="1" class="number_text">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥545</li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="#" class="product_img left"><img src="/image/test/2.jpg" /></a>
                        <p class="cart_content">
                            <a href="#" class="title_name">浦江特产绿豌豆天然无污染</a>
                            <span> 礼盒装：20个装</span>
                        </p>
                    </li>
                    <li class="title_width2">￥23<span style="font-size: 12px">/斤</span></li>
                    <li class="title_width3">
                        <div class="Numbers">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="1" class="number_text">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥545</li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
            </div>
            <div class="list_style">
                <div class="class_title">水果馆</div>
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="#" class="product_img left"><img src="/image/test/2.jpg" /></a>
                        <p class="cart_content">
                            <a href="#" class="title_name">浦江特产绿豌豆天然无污染</a>
                            <span> 礼盒装：20个装</span>
                        </p>
                    </li>
                    <li class="title_width2">￥23<span style="font-size: 12px">/斤</span></li>
                    <li class="title_width3">
                        <div class="Numbers">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="1" class="number_text">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥545</li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="#" class="product_img left"><img src="/image/test/2.jpg" /></a>
                        <p class="cart_content">
                            <a href="#" class="title_name">浦江特产绿豌豆天然无污染</a>
                            <span> 礼盒装：20个装</span>
                        </p>
                    </li>
                    <li class="title_width2">￥23<span style="font-size: 12px">/斤</span></li>
                    <li class="title_width3">
                        <div class="Numbers">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="1" class="number_text">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥545</li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
            </div>
            <div class="list_style">
                <div class="class_title">水果馆</div>
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="#" class="product_img left"><img src="/image/test/2.jpg" /></a>
                        <p class="cart_content">
                            <a href="#" class="title_name">浦江特产绿豌豆天然无污染</a>
                            <span> 礼盒装：20个装</span>
                        </p>
                    </li>
                    <li class="title_width2">￥23<span style="font-size: 12px">/斤</span></li>
                    <li class="title_width3">
                        <div class="Numbers">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="1" class="number_text">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥545</li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="#" class="product_img left"><img src="/image/test/2.jpg" /></a>
                        <p class="cart_content">
                            <a href="#" class="title_name">浦江特产绿豌豆天然无污染</a>
                            <span> 礼盒装：20个装</span>
                        </p>
                    </li>
                    <li class="title_width2">￥23<span style="font-size: 12px">/斤</span></li>
                    <li class="title_width3">
                        <div class="Numbers">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="1" class="number_text">
                            <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥545</li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
            </div>


        </div>

        <!--操作-->
        <div class="cart_operating clearfix buy_shopping_cart">
            <div class="cart_operating_style">
                <div class="cart_btn">
                    <a href="#" class="payment_btn"></a>
                </div>
                <div class="cart_price">商品总价：（不含运费）<b>￥545</b></div>

            </div>
        </div>
        <script>
            //马上付款的样式固定在底部
            $(function(){
                var banOffTop=$(".cart_operating_style").offset().top;//获取到距离顶部的垂直距离
                console.log(banOffTop);
                var scTop=0;//初始化垂直滚动的距离
                var height = $(window).height();
                // console.log(height);
                $(document).scroll(function(){
                    scTop=$(this).scrollTop();//获取到滚动条拉动的距离
                    // console.log(scTop);
                    if(scTop<=banOffTop-height){
                        $(".cart_operating_style").addClass("shopping_cart_fixDiv");
                    }else{
                        $(".cart_operating_style").removeClass("shopping_cart_fixDiv");
                    }
                })
            })
        </script>
    </div>
</div>
@endsection