@extends('Home.common')

@section('common')
    <script src="/js/home/home.js" type="text/javascript"></script>
    <script src="/js/fly-master/dist/jquery.fly.min.js"></script>
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
        <div class="left">当前位置：
            <a href="/product">所有商品</a>&gt;
            <a href="/productList/{{$product['category_top_id']['category_id']}}">{{$product['category_top_id']['category_name']}}</a>
        </div>
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
                    <div class="product_name"><h2>{{isset($product['product_name'])?$product['product_name']:null}}</h2><span>产地：{{isset($product['product_origin'])?$product['product_origin']:null}}</span></div>
                    <div class="product_price">
                        <div class="price"><label>优惠价：</label>￥{{isset($product['present_price'])?$product['present_price']:null}} <b>元/{{isset($product['unit'])?$product['unit']:null}}</b></div>
                        <div class="jyScore-fra"><span><em style="width:60px;"></em></span><b></b><a href="#">共有{{$haoping+$zhongping+$chaping}}条评论</a></div>
                    </div>
                    <div class="productDL">
                        <dl style="height: 100px;">
                            <dt style="float: left;width: 80px;">产品说明：</dt>
                            <dd class="left"style="float: left;width: 400px;">
                                @foreach($product['about_product'] as $key=>$value)
                                <div class="item" style="width: 132px;">
                                    <b></b>
                                    <a href="#none" >{{$key}}：{{$value}}</a>
                                </div>
                                @endforeach

                            </dd>
                        </dl>

                        <dl style="padding-top: 30px;">
                            <dt>数量：</dt>
                            <dd class="left">
                                <div class="Numbers">
                                    <a href="javascript:void(0);" onclick="updatenum(this)" class="jian">-</a>
                                    <input id="number" name="number" type="text" value="1" class="number_text">
                                    <a href="javascript:void(0);" onclick="updatenum(this)" class="jia">+</a>
                                </div>
                            </dd><dd class="left Quantity">(库存：{{$product['product_num']}})</dd>
                        </dl>
                    </div>
                    <div class="product_Quantity">销量：3440</div>
                    <div class="add_collect">加入收藏夹</div>
                    <div class="operating">
                        <a href="/buyNowOrder/{{isset($product['product_id'])?$product['product_id']:null}}/1" class="buy_btn "></a>
                        <a href="javascript:void(0);" class="Join_btn  addcar orange " attr="{{isset($product['product_id'])?$product['product_id']:null}}" store_id ="{{isset($product['store_id'])?$product['store_id']:null}}"></a>
                        {{--<a href="/addCollect/{{$product['product_id']}}" class="Collect_btn"></a>--}}
                        <a href="javascript:void(0);" class="Collect_btn"></a>
                    </div>
                </div>
            </div>
            <!--信息展示-->
            <div class="mainListRight ">
                <ul class="fixed_bar " style="">
                    <li class="status_on active" onclick="status1()"><a>产品介绍</a></li>
                    <li class="status_on" onclick="status2()"><a>商品评价<span>({{$haoping+$zhongping+$chaping}})</span></a></li>
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

                //评论 图片放大
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


                $(function() {
                    var offset = $("#end").offset();
                    // console.log(offset);
                    //加入购物车样式
                    $(".addcar").click(function(event){
                        var addcar = $(this);
                        //判断用户是否已经登陆
                        var user_id = $('#top_cullom_user_id').attr('attr');
                        //ajax 将数据存入数据库
                        var data = {};
                        data.user_id = user_id;
                        data.product_id = addcar.attr('attr');
                        data.num = 1;
                        data.store_id = addcar.attr('store_id');
                        $.post('/api/addShoppingCart' , data , function(res){
                            if(res){
                                console.log(res);
                            }
                        });
                        //加入购物车样式
                        var img = addcar.parent().parent().parent().find('img').attr('src');
                        console.log(img);
                        var flyer = $('<img class="u-flyer" src="'+img+'">');
                        flyer.fly({
                            start: {
                                left: event.pageX, //开始位置（必填）#fly元素会被设置成position: fixed
                                top: event.pageY //开始位置（必填）
                            },
                            end: {
                                left: offset.left+10, //结束位置（必填）
                                top: offset.top+10, //结束位置（必填）
                                width: 0, //结束时宽度
                                height: 0 //结束时高度
                            },
                            onEnd: function(){ //结束回调
                                $("#msg").show().animate({width: '250px'}, 200).fadeOut(1000); //提示信息
                                addcar.css("cursor","default").removeClass('orange').unbind('click');
                                this.destory(); //移除dom
                            }
                        });
                    });

                    //加入收藏

                    $('.Collect_btn').click(function(){
                        var user_id = $('#top_cullom_user_id').attr('attr');
                        //判断用户是否已经登陆
                        var data = {};
                        data.product_id = "{{$product['product_id']}}";
                        data.user_id = user_id;
                        console.log(data);
                        $.post('/api/addCollect' , data , function(res){
                            if(res){
                                $('.add_collect').show().animate({bottom: '140px'}, 200).fadeOut(1000); //提示信息
                            }
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
                        <div class="percent-con">{{$haopingdu}}<span>%</span></div>
                    </div>
                    <div class="percent-info">
                        <div class="tag-list ">
                            <span>好评（{{$haoping}}）</span>
                            <span>中评（{{$zhongping}}）</span>
                            <span>差评（{{$chaping}}）</span>
                        </div>
                    </div>
                </div>
                <div class="tab-main small">
                    <ul class="filter-list">
                        <li style="width: 120px;">
                            <a href="javascript:void(0);">全部评论（{{$haoping+$zhongping+$chaping}}）</a>
                        </li>
                        <li style="width: 100px;">
                            <a href="javascript:void(0);">好评（{{$haoping}}）</a>
                        </li>
                        <li style="width: 100px;">
                            <a href="javascript:void(0);">中评（{{$zhongping}}）</a>
                        </li>
                        <li style="width: 100px;">
                            <a href="javascript:void(0);">差评（{{$chaping}}）</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-con">
                    @if(!empty($comment))
                        @foreach($comment as $value)
                            <div class="comment-item">
                                <div class="user-column">
                                    <div class="user-info">
                                        <img src="{{isset($value['menber']['member_pic'])?$value['menber']['member_pic']:'/image/test/2.jpg'}}" width="30" height="30"/>{{isset($value['user']['name'])?$value['user']['name']:null}}
                                    </div>
                                    <div class="user-level">
                                        <span style="color: rgb(136,136,136);"></span>
                                    </div>
                                </div>
                                <div class="comment-column J-comment-column">
                                    <div class="comment-star star{{isset($value['haoping'])?$value['haoping']:null}}"></div>
                                    <p class="comment-con">
                                        {{isset($value['comment'])?$value['comment']:null}}
                                    </p>
                                    <div class="pic-list">
                                        @if($value['comment_pic'])
                                            @foreach($value['comment_pic'] as $val)
                                                <a class="J-thumb-img">
                                                    <img src="{{$val}}" width="48" height="48"/>
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="cursor-small" style="display: none">
                                        <img src="/image/test/1.jpg" width="50%" />
                                    </div>
                                    <div class="comment-message">
                                        <div class="order-info">
                                            <span>{{isset($value['created_at'])?$value['created_at']:null}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center;padding-top: 30px;">
                            <a >暂无评论！</a>
                        </div>
                    @endif

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
        <div class="cailan" >
            <a href="/shoppingCart">
                <img src="/image/test/6.jpg" width="100px" id="end" />
            </a>

        </div>
    </div>
</div>
@endsection