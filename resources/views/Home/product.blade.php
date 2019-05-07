@extends('Home.common')

@section('common')
    <script src="/js/fly-master/dist/jquery.fly.min.js"></script>
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
                <div class="left">当前位置：<a href="/home_index">首页</a>&gt;<a href="/product">所有商品</a></div>
                <div class="right Search">
                    <form action="/search" method="get">
                        <input name="search" type="text"  class="Search_Box"/>
                        <input name="up" type="submit" class="Search_btn" value=""/>
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
                //加入购物车样式
                var img = addcar.parent().parent().find('img').attr('src');
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
        });
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
                            <p class="btn_style">
                                {{--<a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                {{--<a href="javascript:void(0);" class="Join_btn  addcar orange "></a>--}}
                                {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                @guest
                                    <a href="/addShoppingCartLogin/0" class="buy_btn"></a>
                                    <a  href="/addShoppingCartLogin/0" class="Join_btn orange"></a>
                                @else
                                    <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/1" class="buy_btn"></a>
                                    <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                @endguest
                            </p>
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
                    <p class="title_x_name">[有机蔬菜小知识]</p>
                    <p class="x_info">
                        多吃蔬菜能够预防心脏病的发生。蔬菜中的维生素C、维生素E、胡萝卜素、番茄红素和微量元素等都可以对心脏病预防起到一定的作用。
                        微量元素硒对致癌物质具有抑制作用，蔬菜中所含的叶绿素具有能使细胞活力增强的作用，可以使人身体的免疫系统与机体的自我修复能力增强，以达到抗癌的作用。
                    </p>
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
                                <p class="btn_style">
{{--                                    <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                    {{--<a href="javascript:void(0);" class="Join_btn  addcar orange "></a>--}}
                                    {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                    @guest
                                        <a href="/addShoppingCartLogin/0" class="buy_btn"></a>
                                        <a  href="/addShoppingCartLogin/0" class="Join_btn orange"></a>
                                    @else
                                        <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/1" class="buy_btn"></a>
                                        <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                    @endguest
                                </p>
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
                    <p class="title_x_name">[吃海鲜小知识]</p>
                    <p class="x_info">
                        药物之间有搭配禁忌，食物也是，海鲜更不例外。吃海鲜时不宜畅饮啤酒，这样容易导致血尿酸水平急剧升高，诱发痛风，以致出现痛风性肾病、痛风性关节炎等。 海鲜不宜与富含鞣酸的水果如柿子、葡萄等一起吃，如果要吃的话至少应间隔2个小时，因为鞣酸会破坏海鲜中的优质蛋白，大大降低海鲜的营养价值。
                    </p>
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
                                <p class="btn_style">
                                    {{--<a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                    {{--<a href="javascript:void(0);" class="Join_btn  addcar orange "></a>--}}
                                    {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                    @guest
                                        <a href="/addShoppingCartLogin/0" class="buy_btn"></a>
                                        <a  href="/addShoppingCartLogin/0" class="Join_btn orange"></a>
                                    @else
                                        <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/1" class="buy_btn"></a>
                                        <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                    @endguest
                                </p>
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
                    <p class="title_x_name">[五谷杂粮小知识]</p>
                    <p class="x_info">
                        五谷杂粮的杂粮通常是指水稻、小麦、玉米、大豆和薯类五大作物以外的粮豆作物。主要有：高粱、谷子、荞麦（苦荞）、燕麦（莜麦）、大麦、糜子、黍子、薏仁、籽粒苋以及菜豆（芸豆）、绿豆、小豆（红小豆、赤豆）、蚕豆、豌豆、豇豆、小扁豆（兵豆）、黑豆等。其特点是生长期短、种植面积少、种植地区特殊、产量较低，一般都含有丰富的营养成分。
                    </p>
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
                                <p class="btn_style">
                                    {{--<a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                    {{--<a href="javascript:void(0);" class="Join_btn  addcar orange "></a>--}}
                                    {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                    @guest
                                        <a href="/addShoppingCartLogin/0" class="buy_btn"></a>
                                        <a  href="/addShoppingCartLogin/0" class="Join_btn orange"></a>
                                    @else
                                        <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/1" class="buy_btn"></a>
                                        <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                    @endguest
                                </p>
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
                    <p class="title_x_name">[农副产品小知识]</p>
                    <p class="x_info">
                        农副产品加工是农副产品产出以后，进入消费领域以前所进行的一系列再制造活动。收购企业向生产者收购来的农副产品，大多数是未经加工的初级产品，不仅规格、质量很不一致，而且有的农副产品还含有大量的水分和杂质。为便于贮存、调运和销售，就必须通过初步加工来清除杂质、统一规格。
                    </p>
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
                                <p class="btn_style">
{{--                                    <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                    {{--<a href="javascript:void(0);" class="Join_btn  addcar orange "></a>--}}
                                    {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                    @guest
                                        <a href="/addShoppingCartLogin/0" class="buy_btn"></a>
                                        <a  href="/addShoppingCartLogin/0" class="Join_btn orange"></a>
                                    @else
                                        <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/1" class="buy_btn"></a>
                                        <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                    @endguest
                                </p>
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
                    <p class="title_x_name">[苗木小知识]</p>
                    <p class="x_info">
                        苗木是具有根系和苗干的树苗。凡在苗圃中培育的树苗不论年龄大小，在未出圃之前，都称苗木。苗木种类：实生苗、营养繁殖苗、移植苗、留床苗。苗木还可以按照乔灌木分类，一般在北方乔木苗比较多，南方灌木比较多，这主要是由于生长气候所引起的。
                    </p>
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
                                <p class="btn_style">
                                    {{--<a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                    {{--<a href="javascript:void(0);" class="Join_btn  addcar orange "></a>--}}
                                    {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                    @guest
                                        <a href="/addShoppingCartLogin/0" class="buy_btn"></a>
                                        <a  href="/addShoppingCartLogin/0" class="Join_btn orange"></a>
                                    @else
                                        <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/1" class="buy_btn"></a>
                                        <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                    @endguest
                                </p>
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
                    <p class="title_x_name">[农资农机小知识]</p>
                    <p class="x_info">
                        农机是指农用机械，包含范围很广，比如拖拉机、收割机、插秧机、播种机、脱粒机等等，农机属于农业生产资料（即农资）的一种；农资就是指农业生产资料，包括农药，化肥，种子，农膜，农机等。
                    </p>
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
                                <p class="btn_style">
                                    {{--<a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                    {{--<a href="javascript:void(0);" class="Join_btn  addcar orange "></a>--}}
                                    {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                    @guest
                                        <a href="/addShoppingCartLogin/0" class="buy_btn"></a>
                                        <a  href="/addShoppingCartLogin/0" class="Join_btn orange"></a>
                                    @else
                                        <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/1" class="buy_btn"></a>
                                        <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                    @endguest
                                </p>
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
                    <p class="title_x_name">[种子小知识]</p>
                    <p class="x_info">
                        种子（seed），裸子植物和被子植物特有的繁殖体，它由胚珠经过传粉受精形成。种子一般由种皮、胚和胚乳3部分组成，有的植物成熟的种子只有种皮和胚两部分。种子的形成使幼小的孢子体胚珠得到母体的保护，并像哺乳动物的胎儿那样得到充足的养料。种子还有种种适于传播或抵抗不良条件的结构，为植物的种族延续创造了良好的条件。所以在植物的系统发育过程中种子植物能够代替蕨类植物取得优势地位。
                    </p>
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
                                <p class="btn_style">
                                    {{--<a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_btn"></a>--}}
                                    {{--<a href="javascript:void(0);" class="Join_btn  addcar orange "></a>--}}
                                    {{--判断是否已经登陆 如果没有登陆 不能加入购物车--}}
                                    @guest
                                        <a href="/addShoppingCartLogin/0" class="buy_btn"></a>
                                        <a  href="/addShoppingCartLogin/0" class="Join_btn orange"></a>
                                    @else
                                        <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/1" class="buy_btn"></a>
                                        <a href="javascript:void(0);" class="Join_btn addcar orange" attr="{{isset($value['product_id'])?$value['product_id']:null}}" store_id ="{{isset($value['store_id'])?$value['store_id']:null}}"></a>
                                    @endguest
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="cailan" >
            <a href="/shoppingCart">
                <img src="/image/test/6.jpg" width="100px" id="end" />
            </a>
        </div>

    </div>
@endsection