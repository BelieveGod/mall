<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="order by dede58.com"/>
    <link href="/css/home/css.css" rel="stylesheet" type="text/css" />
    <link href="/css/home/common.css" rel="stylesheet" tyle="text/css" />
    <link href="/css/home/Orders.css" rel="stylesheet" type="text/css" />
    <script src="/js/home/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="/js/home/jquery.reveal.js" type="text/javascript"></script>
    <script src="/js/home/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
    <script src="/js/home/jquery.sumoselect.min.js" type="text/javascript"></script>
    <script src="/js/home/common_js.js" type="text/javascript"></script>
    <script src="/js/home/footer.js" type="text/javascript"></script>
    {{--<script src="/js/home/jquery.jumpto.js" type="text/javascript"></script>--}}
    <title>确认订单界面</title>
</head>
<script type="text/javascript">
    $(document).ready(function () {
        window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
        window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
    });
</script>
<body>
<div class="top_header">
    <em class="left_img"></em>
    <div class="header clearfix" id="header">
        <a href="/home_index" class="logo_img">
            <img src="/image/home/logo.png" style="width: 375px;height: 95px"/>
        </a>
        <div class="header_Section" style="width: 760px;">
            <div class="shortcut">
                <ul>
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
                    <li  class="hd_menu_tit"><em class="Collect_img"></em><a href="/userCollect">收藏夹</a></li>
                    <li  class="hd_menu_tit"><em class="cart_img"></em><a href="/shoppingCart">购物车（0）</a></li>
                </ul>
            </div>
        </div>
    </div>
    <em class="right_img"></em>

</div>
{{--上面样式--}}
<div class="shop_cart" style="max-width: 1250px;margin: 0 auto;">
    <div class="schedule1" style="float: right"></div>
</div>
<div id="Orders" class="Inside_pages  clearfix" >
    <div class="Orders_style clearfix"style="float:left">
        <div class="address clearfix">
            <div class="title">收货人信息</div>
            <div class="adderss_list clearfix">
                {{--<div class="title_name">选择收货地址 <a href="#">+添加地址</a></div>--}}
                {{--选择收货地址样式 最多显示4个--}}
                <div class="ord_list">
                @if(!empty($user_address))
                    @foreach($user_address as $value)
                        @if($value['status'] == 1)
                        <div class="addr" id="add_active" attr="{{isset($value['user_address_id'])?$value['user_address_id']:null}}">
                        @else
                        <div class="addr" id="" attr="{{isset($value['user_address_id'])?$value['user_address_id']:null}}">
                        @endif
                            <div class="inner">
                                <div class="addr-hd">
                                    <span>东莞&nbsp;&nbsp;{{isset($value['region_name'])?$value['region_name']:null}}</span>
                                    <span>({{isset($value['name'])?$value['name']:null}} 收)</span>
                                </div>
                                <div class="addr-bd">
                                    <span>{{isset($value['address'])?$value['address']:null}}</span>
                                    <span>{{isset($value['tell'])?$value['tell']:null}}</span>
                                </div>
                                <div class="addr-toolbar">
                                    @if($value['status'] == 1)
                                        <a>默认地址</a>
                                    @else
                                        <a>&nbsp;</a>
                                    @endif

                                </div>
                            </div>
                            <div class="curMarker"></div>
                            <div class="setDefault"></div>
                            <div class="option"></div>
                        </div>
                    @endforeach
                @else
                    <div style="width: 200px;height: 80px;border:1px dashed #F60;border-radius: 5px;text-align: center;line-height: 80px; color:#F60;cursor: pointer;" onclick="addAddressOnOrder(this)">
                        <b>+</b><span style="margin-left: 5px;">添加地址</span>
                    </div>
                @endif
                </div>
            </div>
                <div id="send-address-back"  style="display:none;position: fixed;left: 0;top: 0;width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);z-index: 10000">
                    <div id="div1"  style="background:#eeeeee;width: 40%;z-index:10001;margin: 12% auto;overflow: auto;">
                        <div id="close" style="padding: 5px;background: #85c12e;">
                            <span id="send-address-close-button" style="color: white;cursor: pointer;padding-right: 15px;float: right;font-size: 30px;" >×</span>
                            <h2 style="margin: 10px 0;color: white;padding-left: 8px; font-size: 18px">添加地址</h2>
                        </div>
                        <div id="div2" style="background:#eeeeee;margin: auto;height: 300px;padding: 0 20px;" class="order-add-address">
                            <form action="/api/order_add_address" method="post">
                                <div style="margin-top: 30px;">
                                    <ul>
                                        <li style="margin-top: 10px;">
                                            <label class="user_title_name">收件人姓名：</label>
                                            <input name="name" type="text" class="add_text" value="">
                                        </li>
                                        <li style="margin-top: 10px;">
                                            <label class="user_title_name">手 机 号：</label>
                                            <input name="tell" type="text" class="add_text" value="">
                                        </li>
                                        <li style="margin-top: 10px;">
                                            <label class="user_title_name">镇&nbsp;&nbsp;区：</label>
                                            <select style="" class="add_text" name="region">
                                                <option>请选择</option>
                                                @foreach($address as $key=>$value)
                                                <option value="{{$key}}" {{isset($user_address['region'])&&$user_address['region']==$key?'selected':null}}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                        <li style="margin-top: 10px;">
                                            <label class="user_title_name">详细地址：</label>
                                            <input name="address" type="text" class="add_text" value="" >
                                        </li>
                                    </ul>
                                </div>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />


                                <div style="float: right;margin:8px; ">
                                    <button class="btn_topic" onclick="sureBusinessAddress()">确定</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <script>
                $('.ord_list').find('.addr').each(function (){
                    $(this).on('click',function(){
                        $('.ord_list').find('.addr').attr('id' , '');
                        $(this).attr('id' , 'add_active');
                    });
                });

                function addAddressOnOrder(obj)
                {
                    $('#send-address-back').css('display','block');
                }

                $('#send-address-close-button').click(function (){
                    $('#send-address-back').css('display','none');
                });

            </script>

            </div>

            {{--<form class="form" method="post">--}}
            <form name=alipayment action='/api/alipay' method=post target="_blank">
            {{--<form name=alipayment action='/api/alipay' method=post>--}}
                <fieldset>
                    <!--付款方式-->
                    {{--<div class="payment">--}}
                        {{--<div class="title_name">支付方式</div>--}}
                        {{--<ul>--}}
                            {{--<li><input type="radio" name="radio" data-labelauty="支付宝"></li>--}}
                            {{--<li><input type="radio" name="radio" data-labelauty="货到付款"></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    <!--产品列表-->
                    <div class="Product_List">
                        @foreach($order as $value)
                        <table style="margin-top: 30px;">
                            <thead>
                            <tr class="title each_store">
                                <td class="name" style="text-align: left;padding-left: 20px;">{{isset($value['store_id']['store_name'])?$value['store_id']['store_name']:null}}</td>
                                <td class="price">商品价格</td>
                                <td class="Quantity">购买数量</td>
                                <td class="Preferential" attr="">运费</td>
                                <td class="Money">金额</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($value['product'] as $val)
                            <tr class="order_product_id" attr="{{isset($val['product']['product_id'])?$val['product']['product_id']:null}}">
                                <td class="Product_info" attr="{{isset($val['shopping_cart_id'])?$val['shopping_cart_id']:null}}">
                                    <a href="#"><img src="/uploads/{{isset($val['product']['product_master_img'][0])?$val['product']['product_master_img'][0]:null}}"  width="100px" height="100px"/></a>
                                    <a href="#" class="product_name">{{isset($val['product']['product_name'])?$val['product']['product_name']:null}}</a>
                                </td>
                                <td><i>￥</i>{{isset($val['product']['present_price'])?$val['product']['present_price']:null}}</td>
                                <td>{{isset($val['num'])?$val['num']:1}}</td>
                                <td><i>￥</i><span class="product_freght">{{isset($val['product']['product_freght'])?$val['product']['product_freght']:null}}</span></td>
                                <td class="Moneys"><i>￥</i><span class="cost_money">{{isset($val['product']['cost'])?$val['product']['cost']:null}}</span></td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                        @endforeach


                        <div class="Pay_info">
                            <label>订单留言</label><input name="" type="text"  onkeyup="checkLength(this);" class="text_name " />  <span class="wordage">剩余字数：<span id="sy" style="color:Red;">50</span></span>
                        </div>
                        <!--价格-->
                        <div class="price_style">
                            <div class="right_direction">
                                <ul>
                                    <li><label>商品总价</label><i>￥</i><span class="spzj"></span></li>
                                    <li><label>配&nbsp;&nbsp;送&nbsp;&nbsp;费</label><i>￥</i><span class="psf">0</span></li>
                                    <li class="shiji_price"><label>实&nbsp;&nbsp;付&nbsp;&nbsp;款</label><i>￥</i><span class="sfk">425.00</span></li>
                                </ul>
                                <div class="btn">
                                    <input name="" type="button" value="返回购物车"  class="return_btn"/>
                                        <input id="WIDout_trade_no" name="WIDout_trade_no"  type="hidden" value="{{'2019'.time()}}"/>
                                        <input id="WIDsubject" name="WIDsubject" type="hidden" value=""/>
                                        <input id="WIDtotal_amount" name="WIDtotal_amount" type="hidden" value=""/>
                                        <input id="WIDbody" name="WIDbody" type="hidden"/>
                                        <input name="submit" type="submit" value="提交订单" class="submit_btn" onclick="inputOrder(this)"/>
                                    {{--<input name="submit" type="button" value="提交订单" class="submit_btn" onclick="inputOrder(this)"/>--}}
                                </div>
                                <div class="integral right">待订单确认后，你将获得<span class="jf"></span>积分</div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            //商品总价
            var cost = 0;
            $('.Product_List').find('.cost_money').each(function (){
                var cost_pnce = $(this).text();
                cost += Math.floor(cost_pnce * 100) / 100;
            });
            $('.spzj').text(cost);
            //配送费
            var freght = 0;
            $('.Product_List').find('.product_freght').each(function (){
                var product_freght = $(this).text();
                freght += Math.floor(product_freght * 100) / 100;
            });
            $('.psf').text(freght);
            //实付款
            $('.sfk').text(Math.floor( (freght+cost) * 100) / 100);
            $('#WIDtotal_amount').val(Math.floor( (freght+cost) * 100) / 100);
            //积分
            $('.jf').text(parseInt(cost));

            var pro_name = $('.Product_List').find('.Product_info').eq(0).find('.product_name').text();
            $('#WIDsubject').val(pro_name);

        });

        function checkLength(which) {
            var maxChars = 50; //
            if(which.value.length > maxChars){
                alert("您出入的字数超多限制!");
                // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
                which.value = which.value.substring(0,maxChars);
                return false;
            }else{
                var curr = maxChars - which.value.length; //250 减去 当前输入的
                document.getElementById("sy").innerHTML = curr.toString();
                return true;
            }
        }

        function inputOrder(obj)
        {
            //订单应该分商店，可以是同一个订单号，但是涉及到的商家应该都能看到这个订单和对商品相应地发货
            var data = {};
            data.user_id = $('#top_cullom_user_id').attr('attr');
            data.address_id = $('#add_active').attr('attr');
            var shopping_cart = new Array();
            // data.shopping_cart =
            $('.Product_List').find('.Product_info').each(function(){
                var temp = $(this).attr('attr');
                shopping_cart.push(temp);
            });
            data.shopping_cart = shopping_cart;
            data.spzj = $('.spzj').text();
            data.psf = $('.psf').text();
            data.sfk = $('.sfk').text();
            data.integral = $('.jf').text();
            data.memo = $('.Pay_info').find('input').val();
            data.pro = $('.order_product_id').attr('attr');
            console.log(data);
            $.post('/api/saveOrders' , data , function(res){
                console.log(res);
            });
        }


    </script>
    <script>
        $(function(){
            $(':input').labelauty();
        });
    </script>
</body>
</html>
