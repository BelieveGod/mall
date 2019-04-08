@extends('Home.common')

@section('common')
<script src="/js/home/home.js" type="text/javascript"></script>
<div class="Narrow">
    <div class="shop_cart">
        @if(empty($shoppingCart))
            <div class="call_Inside_pages clearfix" style='background-image: url("/image/home/shopCartNull.png");
    background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%; margin-bottom: 100px;'>
                <div class="clearfix user" style="">
                    <div class="call_user_right"style="background: rgba(255,255,255,0.6);">
                        <div class="user_Borders" style="min-height: 450px">
                            <div class="title_name">
                                {{--<span class="name">申请成功</span>--}}
                                <a href="/product" style="float:right">往商城》</a>
                            </div>
                            <div class="about_user_info">
                                <ul style="margin-left: 30px; margin-right: 30px;">
                                    <li></li>
                                    <li></li>
                                    <li style="color: #848484;text-align: center">

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
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
            @foreach($shoppingCart as $value)
            <div class="list_style">
                <div class="class_title">{{isset($value['store_id']['store_name'])?$value['store_id']['store_name']:null}}</div>
                @foreach($value['product'] as $val)
                <ul class="product_cart">
                    <li class="title_width"><input type="checkbox" id="rememberMe"></li>
                    <li class="title_width1">
                        <a href="/productDetailed/{{isset($val['product']['product_id'])?$val['product']['product_id']:null}}" class="product_img left"><img src="/uploads/{{isset($val['product']['product_master_img'][0])?$val['product']['product_master_img'][0]:null}}" /></a>
                        <p class="cart_content">
                            <a href="/productDetailed/{{isset($val['product']['product_id'])?$val['product']['product_id']:null}}" class="title_name" style="max-width: 10em;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{isset($val['product']['product_name'])?$val['product']['product_name']:null}}</a>
                            {{--<span> 礼盒装：20个装</span>--}}
                        </p>
                    </li>
                    <li class="title_width2" style="font-size: 16px;" >￥<i>{{isset($val['product']['present_price'])?$val['product']['present_price']:null}}</i><span style="font-size: 12px">/{{isset($val['product']['unit'])?$val['product']['unit']:null}}</span></li>
                    <li class="title_width3">
                        <div class="Numbers" shoppingCart_id="{{isset($val['shopping_cart_id'])?$val['shopping_cart_id']:null}}">
                            <a href="javascript:void(0);" onclick="shopUpdatenum(this)" class="jian">-</a>
                            <input id="number" name="number" type="text" value="{{isset($val['num'])?$val['num']:1}}" class="number_text" oninput="changePrice(this)" />
                            <a href="javascript:void(0);" onclick="shopUpdatenum(this)" class="jia">+</a>
                        </div>
                    </li>
                    <li class="title_width4">￥<span>{{isset($val['product']['cost'])?$val['product']['cost']:null}}</span></li>
                    <li class="title_width5"><a href="#">删除</a></li>
                </ul>
                @endforeach
            </div>
            @endforeach
        </div>

        <!--操作-->
        <div class="cart_operating clearfix buy_shopping_cart">
            <div class="cart_operating_style">
                <div class="cart_btn">
                    <a href="#" class="payment_btn"></a>
                </div>
                <div class="cart_price">商品总价：（不含运费）<b>￥<span>0</span></b></div>

            </div>
        </div>
        @endif
        <script>
            //马上付款的样式固定在底部
            $(function(){
                var banOffTop=$(".cart_operating_style").offset().top;//获取到距离顶部的垂直距离
                // console.log(banOffTop);
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
            });

            //
            function changePrice(obj)
            {
                var num = $(obj).val();
                console.log(num);
            }
        </script>
    </div>
</div>
@endsection