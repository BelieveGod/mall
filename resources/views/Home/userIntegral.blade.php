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
                    <div class="Integral_Number"><em></em>你当前的积分：<b>{{$countUserIntegral['count_num']}}</b></div>
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
                        @foreach($integral_list as $value)
                        <tr>
                            <td>4546546546454</td>
                            <td>￥345</td>
                            <td>455</td>
                            <td>2019-3-12 12:23:34</td>
                        </tr>
                        @endforeach
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