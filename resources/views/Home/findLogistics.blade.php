@extends('Home.memberInfo')

@section('info')

<div class="user_right">
    <div class="Order_form" style="margin-bottom: 100px;">
        <div class="user_Borders">
            <div class="title_name">
                <span class="name">物流信息</span>
                <a href="/userForm">查看订单&gt;&gt;</a>
            </div>
            <div class="Order_form_list">
                @if(!empty($data['data']))
                <ul style="margin: 60px;" class="wuliu">
                    @foreach($data['data'] as $value)
                    <li>
                        <i style="color: #8c8c8c">{{isset($value['time'])?$value['time']:null}}</i>
                        <span style="margin-left: 40px;color: #8c8c8c">{{isset($value['context'])?$value['context']:null}}</span>
                    </li>
                    @endforeach
                </ul>
                @else
                    <div style="margin-top: 100px;margin-bottom: 100px;text-align: center;">
                        <img src="/image/home/no_data.png" width="150px;"/>
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>
@endsection