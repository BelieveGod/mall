@extends('Home.memberInfo')

@section('info')
<script type="text/javascript">
    $(document).ready(function(){

        setInterval(showTime, 1000);
        function timer(obj,txt){
            obj.text(txt);
        }
        function showTime(){
            var today = new Date();
            var weekday=new Array(7)
            weekday[0]="星期日"
            weekday[1]="星期一"
            weekday[2]="星期二"
            weekday[3]="星期三"
            weekday[4]="星期四"
            weekday[5]="星期五"
            weekday[6]="星期六"
            var y=today.getFullYear()+"年";
            var month=today.getMonth()+1+"月";
            var td=today.getDate();
            var d=weekday[today.getDay()];
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            timer($("#y"),y+month);
            //timer($("#MH"),month);
            timer($("h1"),td);
            timer($("#D"),d);
            timer($("#H"),h);
            timer($("#M"),m);
            timer($("#S"),s);
        }
    })
</script>
<div class="user_right">
    <div class="user_center_style">
        <div class="user_time">
            <h1></h1>
            <h4 id="D"></h4>
            <h4 id="y"></h4>
        </div>
        <ul class="user_center_info">
            <li>
                <img src="/image/home/user_img_04.png" />
                <a href="/userForm/1">待发货（{{$dfh}}）</a>
            </li>
            <li>
                <img src="/image/home/user_img_04.png" />
                <a href="/userForm/4">待收货（{{$dsh}}）</a>
            </li>
            <li>
                <img src="/image/home/user_img_05.png" />
                <a href="/userForm/6">售后（{{$shouhou}}）</a>
            </li>
            <li>
                <img src="/image/home/user_img_03.png" />
                <a href="/userForm/5">订单评价（{{$ddpj}}）</a>
            </li>
        </ul>
    </div>
    <div class="Order_form" style="margin-bottom: 100px;">
        <div class="user_Borders">
            <div class="title_name">
                <span class="name">我的订单</span>
                <a href="/userForm/8">更多订单&gt;&gt;</a>
            </div>
            <div class="Order_form_list">
                <table>
                    <thead>
                    <td class="list_name_title0">商品</td>
                    <td class="list_name_title1">单价(元)</td>
                    <td class="list_name_title2">数量</td>
                    <td class="list_name_title4">实付款(元)</td>
                    <td class="list_name_title5">订单状态</td>
                    <td class="list_name_title6">操作</td>
                    </thead>
                    @foreach($allOrder as $value)
                        <tbody>
                        <tr><td colspan="6" class="Order_form_time">订单号：{{isset($value['form_num'])?$value['form_num']:null}}</td></tr>
                        <tr>
                            <td colspan="3">
                                <table class="Order_product_style">
                                    @for ($i = 0; $i < count($value['pro']); $i++)
                                    {{--@foreach($value['pro'] as $val)--}}
                                    <tr>
                                        <td>
                                            <div class="product_name clearfix">
                                                <a href="/productDetailed/{{isset($value['pro'][$i]['product_id'])?$value['pro'][$i]['product_id']:null}}"><img src="/uploads/{{isset($value['pro'][$i]['product_master_img'][0])?$value['pro'][$i]['product_master_img'][0]:null}}"  width="80px" height="80px"/></a>
                                                <a href="/productDetailed/{{isset($value['pro'][$i]['product_id'])?$value['pro'][$i]['product_id']:null}}" style="max-width: 11em;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{isset($value['pro'][$i]['product_name'])?$value['pro'][$i]['product_name']:null}}</a>
                                            </div>
                                        </td>
                                        <td>{{isset($value['pro'][$i]['present_price'])?$value['pro'][$i]['present_price']:null}}</td>
                                        <td>{{isset($value['num'][$i])?$value['num'][$i]:null}}</td>
                                    </tr>
                                    {{--@endforeach--}}
                                    @endfor
                                </table>
                            </td>

                            <td class="split_line">{{isset($value['form_cost'])?$value['form_cost']:null}}</td>
                            <td class="split_line">{{isset($value['status_name'])?$value['status_name']:null}}</td>
                            @if($value['status'] == \App\Model\ProductForm::SIGN_FOR_GOOD)
                                <td><a href="/add_user_comment/{{isset($value['form_id'])?$value['form_id']:null}}">评价</a></td>
                            @elseif($value['status'] == \App\Model\ProductForm::WAIT_DELIVER_GOODS)
                                <td><a href="javascript:void(0);">提醒发货</a></td>
                            @elseif($value['status'] == \App\Model\ProductForm::DELIVER_GOODS)
                                <td><a href="javascript:void(0);">查看物流</a></td>
                            @endif
                        </tr>
                        </tbody>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>
@endsection