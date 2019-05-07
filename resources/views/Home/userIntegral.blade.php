@extends('Home.memberInfo')

@section('info')
<div class="user_right">
    <div class="user_Borders">
        <div class="title_name">
            <span class="name">用户积分</span>
        </div>
        <!--积分样式-->
        <div class="user_integral_style slideTxtBox">
            {{--<div class="hd">--}}
                {{--<ul>--}}
                    {{--<li>积分获取记录</li>--}}
                    {{--<li>积分兑换</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            <div class="bd">
                <ul>
                    <div class="Integral_Number"><em></em>你当前的积分：<b>{{isset($countUserIntegral->count_num)?$countUserIntegral->count_num:0}}</b></div>
                    <table>
                        <thead>
                        <tr>
                            <td>积分获取订单号</td>
                            <td>订单金额</td>
                            <td>积分</td>
                            <td>获取日期</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($integral_list))
                            <tr style="height: 200px;">
                                <td colspan="4" style="color: #8c8c8c">你的积分为0
                                    <a href="/product" style="color: #F60;"> 前往商城》</a>
                                </td>

                            </tr>
                        @else
                            @foreach($integral_list as $value)
                                <tr>
                                    <td>{{$value['form_num']}}</td>
                                    <td>￥{{$value['cost']}}</td>
                                    <td>{{$value['integral']}}</td>
                                    <td>{{$value['created_at']}}</td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </ul>
                {{--<ul>--}}
                    {{--<div class="Integral_Number"><em></em>你消费的积分：<b>544</b></div>--}}
                {{--</ul>--}}
            </div>
        </div>
        <script>jQuery(".slideTxtBox").slide({trigger:"click"});</script>
    </div>
</div>
@endsection