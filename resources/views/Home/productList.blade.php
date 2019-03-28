@extends('Home.common')

@section('common')
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
                <div class="left">当前位置：<a href="/home_index">首页</a>&gt;<a href="/product">所有商品</a>&gt;<a href="/productList/{{$menu_title['category_id']}}">{{$menu_title['category_name']}}</a></div>
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
                        <li class="con_list_first_li">
                            {{$menu_title['category_name']}}
                        </li>
                        @foreach($menu as $value)
                        <li>
                            <div>{{$value['type']}}<span>▼</span></div>
                            <ul class="con_list_child">
                                @foreach($value['cvn'] as $key=>$val)
                                <li><a href="/productList/{{$key}}">{{$val}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach

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
                $('.con_list_first_li').on('click',function(){
                    $('.con_list').find('ul').stop().slideDown(500);
                });
            </script>

            <DIV class="right_style">
                <ul class="list_style">
                    @foreach($product as $value)
                    <li class="clearfix">
                        <div class="product_lists clearfix">
                            <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}">
                                <img src="/uploads/{{isset($value['product_master_img'][0])?$value['product_master_img'][0]:null}}" width="210px" height="215px"/>
                            </a>
                            <p class="title_p_name">{{isset($value['product_name'])?$value['product_name']:null}}</p>
                            <p class="title_Profile">产地：{{isset($value['product_origin'])?$value['product_origin']:null}}</p>
                            <p class="price">
                                <del class="del_old_price">￥{{isset($value['prime_cost'])?$value['prime_cost']:null}}</del>
                                <b>￥</b>{{isset($value['present_price'])?$value['present_price']:null}}<span style="font-size: 14px;">/{{isset($value['unit'])?$value['unit']:null}}</span>
                            </p>
                            <p class="btn_style"><a href="javascript;('')" class="buy_btn"></a><a href="javascript;('')" class="Join_btn"></a></p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <!--分页-->
                {{$product->links('Home.pagination.pages')}}

            </DIV>
        </div>
    </div>
@endsection