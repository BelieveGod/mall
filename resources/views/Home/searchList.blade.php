@extends('Home.common')

@section('common')
    <script src="/js/fly-master/dist/jquery.fly.min.js"></script>
    <!--搜索-->
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
    <div >
        <div class="Bread_crumbs">
            <div class="Inside_pages clearfix">
                <div class="left">当前位置：<a href="/home_index">首页</a>&gt;<a href="/product">商品</a>&gt;<a href="/productList/{{isset($menu_title['category_id'])?$menu_title['category_id']:null}}">{{isset($menu_title['category_name'])?$menu_title['category_name']:null}}</a></div>
                <div class="right Search">
                    <form action="/search" method="get">
                        <input name="search" type="text"  class="Search_Box"/>
                        <input name="up" type="submit" class="Search_btn" value=""/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--产品列表-->
    <div class="Inside_pages clearfix">
        <div class="margintop">
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
                $('.con_list_first_li').on('click',function(){
                    $('.con_list').find('ul').stop().slideDown(500);
                });

                //加入购物车样式
                $(function() {
                    var offset = $("#end").offset();
                    // console.log(offset);
                    $(".addcar").click(function(event){
                        var addcar = $(this);
                        //判断用户是否已经登陆
                        var user_id = $('#top_cullom_user_id').attr('attr');
                        if(!user_id){
                            //todo 登陆完成后返回当前页面
                            window.location.href =  '/login';
                            return 'login';
                        }
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
                        //加入购物车的样式
                        var img = addcar.parent().parent().find('img').attr('src');
                        // console.log(img);
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
                });

            </script>
            @if($product->count()==0)
                <div class="comment-wrap">
                    <img src="/image/home/not_fount.jpg" />
                </div>
            @else
            {{--<DIV class="right_style">--}}
                <ul class="list_style prolist" >
                    @foreach($product as $value)
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}">
                                <img class="list_img" src="/uploads/{{isset($value['product_master_img'][0])?$value['product_master_img'][0]:null}}" width="210px" height="215px"/>
                            </a>
                            <p class="title_p_name">{{isset($value['product_name'])?$value['product_name']:null}}</p>
                            <p class="title_Profile">产地：{{isset($value['product_origin'])?$value['product_origin']:null}}</p>
                            <p class="price">
                                <del class="del_old_price">￥{{isset($value['prime_cost'])?$value['prime_cost']:null}}</del>
                                <b>￥</b>{{isset($value['present_price'])?$value['present_price']:null}}<span style="font-size: 14px;">/{{isset($value['unit'])?$value['unit']:null}}</span>
                            </p>
                            <p class="btn_style">
                                {{--<a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                @guest
                                    <a href="/addShoppingCartLogin/{{$value['category_id']}}" class="buy_btn"></a>
                                    <a  href="/addShoppingCartLogin/{{$value['category_id']}}" class="Join_btn orange"></a>
                                @else
                                    <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>
                                    <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                @endguest
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <!--分页-->
                {{$product->links('Home.pagination.pages')}}
            {{--</DIV>--}}
            @endif
        </div>
    </div>

    <div class="cailan" >
        <a href="/shoppingCart">
            <img src="/image/test/6.jpg" width="100px" id="end" />
        </a>
    </div>



@endsection