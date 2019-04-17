@extends('Home.common')

@section('common')
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

<!--团购样式-->
<div class="Inside_pages clearfix">
    <div class="Group_buy">
        <div class="Group_title"><em></em>{{$title}}<span></span></div>
        <div class="Group_list clearfix left_Group left_Group">
            @foreach($product as $value)
            <div class="Group_prodcut">
                <div class="clearfix">
                    <div class="Group_info">
                        <a href="#" class="Collect"></a>
                        <ul>
                            <li class="Group_p_name" style="width: 12em;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                <a href="/productDetailed/{{$value['product_id']}}" >
                                    {{$value['product_name']}}
                                </a>
                            </li>
                            <li class="Group_p_about">产地：{{$value['product_origin']}}</li>
                            <Li>礼盒装 500g</Li>
                            <li class="Group_price"><span class="Current_price"><i>￥</i>{{$value['present_price']}}</span> <del class="Group_List">原价：{{$value['prime_cost']}}</del></li>
                            <li class="Group_p_buy">
                                <span class="Group_Number"><em></em>234人购买</span>
                                <span class="Group_button right">
                                    @guest

                                        <a href="/addShoppingCartLogin/0" class="buy_button"></a>
                                    @else
                                        <a href="/buyNowOrder/{{isset($value['product_id'])?$value['product_id']:null}}/2" class="buy_button"></a>
                                    @endguest
                                    {{--<a href="#" class="buy_button"></a>--}}
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="Group_img">
                        <a href="/productDetailed/{{$value['product_id']}}">
                            <img src="/uploads/{{$value['product_master_img'][0]}}"  height="195" width="365"/>
                        </a>
                    </div>
                </div>
                <div class="Group_time">
                    {{--<em></em>距离结束还有2天4小时32分23秒--}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection