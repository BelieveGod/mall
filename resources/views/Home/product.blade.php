@extends('Home.common')

@section('common')
    <div class="banner" style="z-index: 999; width: 100%">
        <!--导航-->
        <div class="Bread_crumbs pro_crumbs" style="background: #70b701 ; color: #fff">
            <div class="Inside_pages clearfix">
                <div class="left">
                    <ul>
                        <li><a href="#first">新鲜水果</a></li>
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
        <div class="Bread_crumbs" >
            <div class="Inside_pages clearfix">
                <div class="left">当前位置：<a href="/home_index">首页</a>&gt;<a href="#">新鲜水果</a></div>
                <div class="right Search">
                    <form>
                        <input name="" type="text"  class="Search_Box"/>
                        <input name="" type="button"  name="" class="Search_btn"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    </script>

    <!--产品-->
    <div class="Inside_pages" id="first">
        <!--其他特色馆-->
        <div class="fruits_Forum">
            <div class="title_style">
                <div class="title_name">
                    <a href="/productList/2">
                        <span style="font-size: 28px;color: #fff;line-height: 140px;margin-left: 40px;">新鲜水果</span>
                    </a>
                </div>
                <div class="title_info">
                    <p class="title_x_name">[健康水果小知识]</p>
                    <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
                </div>
                {{--<div class="title_img"><img src="/image/home/sg_pro_img_17.png" /></div>--}}
            </div>
            <div class="list_style">
                <ul class="clearfix">
                    @foreach($fruit as $value)
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
            </div>
        </div>
        <div class="vegetables_Forum" id="vertable">
            <div class="title_style">
                <div class="title_name">
                    <a href="/productList/3">
                        <span style="font-size: 28px;color: #fff;line-height: 140px;float: right; margin-right: 120px;">有机蔬菜</span>
                    </a>
                </div>
                <div class="title_info">
                    <p class="title_x_name">[健康水果小知识]</p>
                    <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
                </div>
                {{--<div class="title_img"><img src="images/title_p_img_32.png" /></div>--}}
            </div>
            <div class="list_style">
                <ul class="clearfix">
                    @foreach($vertable as $value)
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
            </div>
        </div>
        <div class="fruits_Forum" id="chicken">
            <div class="title_style">
                <div class="title_name">
                    <a href="/productList/4">
                        <span style="font-size: 28px;color: #fff;line-height: 140px;margin-left: 40px;">畜牧水产</span>
                    </a>
                </div>
                <div class="title_info">
                    <p class="title_x_name">[健康水果小知识]</p>
                    <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
                </div>
                {{--<div class="title_img"><img src="/image/home/sg_pro_img_17.png" /></div>--}}
            </div>
            <div class="list_style">
                <ul class="clearfix">
                    @foreach($chicken as $value)
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
            </div>
        </div>
        <div class="vegetables_Forum" id="rice">
            <div class="title_style">
                <div class="title_name">
                    <a href="/productList/5">
                        <span style="font-size: 28px;color: #fff;line-height: 140px;float: right; margin-right: 120px;">粮油米面</span>
                    </a>
                </div>
                <div class="title_info">
                    <p class="title_x_name">[健康水果小知识]</p>
                    <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
                </div>
                {{--<div class="title_img"><img src="images/title_p_img_32.png" /></div>--}}
            </div>
            <div class="list_style">
                <ul class="clearfix">
                    @foreach($rice as $value)
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
            </div>
        </div>
        <div class="fruits_Forum" id="jiagong">
            <div class="title_style">
                <div class="title_name">
                    <a href="/productList/6">
                        <span style="font-size: 28px;color: #fff;line-height: 140px;margin-left: 40px;">农副加工</span>
                    </a>
                </div>
                <div class="title_info">
                    <p class="title_x_name">[健康水果小知识]</p>
                    <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
                </div>
                {{--<div class="title_img"><img src="/image/home/sg_pro_img_17.png" /></div>--}}
            </div>
            <div class="list_style">
                <ul class="clearfix">
                    @foreach($jiagong as $value)
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
            </div>
        </div>
        <div class="vegetables_Forum" id="flower">
            <div class="title_style">
                <div class="title_name">
                    <a href="/productList/7">
                        <span style="font-size: 28px;color: #fff;line-height: 140px;float: right; margin-right: 120px;">苗木花草</span>
                    </a>
                </div>
                <div class="title_info">
                    <p class="title_x_name">[健康水果小知识]</p>
                    <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
                </div>
                {{--<div class="title_img"><img src="images/title_p_img_32.png" /></div>--}}
            </div>
            <div class="list_style">
                <ul class="clearfix">
                    @foreach($flower as $value)
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
            </div>
        </div>
        <div class="fruits_Forum" id="nongzi">
            <div class="title_style">
                <div class="title_name">
                    <a href="/productList/8">
                        <span style="font-size: 28px;color: #fff;line-height: 140px;margin-left: 40px;">农资农机</span>
                    </a>
                </div>
                <div class="title_info">
                    <p class="title_x_name">[健康水果小知识]</p>
                    <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
                </div>
                {{--<div class="title_img"><img src="/image/home/sg_pro_img_17.png" /></div>--}}
            </div>
            <div class="list_style">
                <ul class="clearfix">
                    @foreach($nongzi as $value)
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
            </div>
        </div>
        <div class="vegetables_Forum" id="seed">
            <div class="title_style">
                <div class="title_name">
                    <a href="/productList/9">
                        <span style="font-size: 28px;color: #fff;line-height: 140px;float: right; margin-right: 120px;">种子种苗</span>
                    </a>
                </div>
                <div class="title_info">
                    <p class="title_x_name">[健康水果小知识]</p>
                    <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
                </div>
                {{--<div class="title_img"><img src="images/title_p_img_32.png" /></div>--}}
            </div>
            <div class="list_style">
                <ul class="clearfix">
                    @foreach($seed as $value)
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
            </div>
        </div>
    </div>
@endsection