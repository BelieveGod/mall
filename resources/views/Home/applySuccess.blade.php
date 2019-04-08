@extends('Home.common')

@section('common')
    <div class="call_Inside_pages clearfix" style='background-image: url("/image/home/call_us.jpg");
    background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%; margin-bottom: 100px;'>
        <div class="clearfix user" style="">
            <div class="call_user_right"style="background: rgba(255,255,255,0.6);">
                <div class="user_Borders" style="min-height: 450px">
                    <div class="title_name">
                        <span class="name">申请成功</span>
                        <a href="/findApplyAdmin" style="float:right">查看申请结果》</a>
                    </div>
                    <div class="about_user_info">
                        <ul style="margin-left: 30px; margin-right: 30px;">
                            <li></li>
                            <li></li>
                            <li style="color: #848484;text-align: center">
                                申请成功，请等待工作人员联系，或1-2个工作日后在相关入口查询。
                                <u><a href="/home_index" style="color: #3ab1e6;font-size: 12px;">往商城》</a></u>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection