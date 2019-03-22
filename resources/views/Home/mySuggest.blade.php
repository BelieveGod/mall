@extends('Home.common')

@section('common')
    <div class="call_Inside_pages clearfix" style='background-image: url("/image/home/call_us.jpg");
    background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%; margin-bottom: 100px;'>
        <div class="clearfix user" style="">
            <div class="call_user_right"style="background: rgba(255,255,255,0.6);">
                <div class="user_Borders" style="min-height: 400px;">
                    <div class="title_name">
                        <span class="name">我的建议</span>
                        <a href="/callAboutUs" style="float:right">反馈问题》</a>
                    </div>
                    <div class="call_about_user_info">
                        <ul style="margin-left: 30px; margin-right: 30px;">
                            @if(empty($suggest))
                            <li style="color: #848484;text-align: center">您还没有给我提意见呢！</li>
                            @else
                                @foreach($suggest as $value)
                                    <li style="width: 100% ; background: rgba(255,255,255,0.8);border-radius: 5px;padding: 5px;">
                                        <div style="color: #848484 ;width: 100%;text-align: right">{{$value['created_at']}}</div>
                                        <div style="float: left">我的建议：</div>
                                        <div style="color: #848484 ; width: 90% ; float: left">{{$value['text']}}</div>
                                        @if($value['reply']!=null)
                                            <div style="margin-top: 20px;margin-bottom: 20px; width: 100% ;float: left">客服回复：</div>
                                            <div style="color: #848484 ;margin-right: 30px; float: left ; margin-left: 20px ; margin-bottom: 20px;">{{$value['reply']}}</div>
                                        @else
                                            <div style="margin-top: 20px;margin-bottom: 20px; width: 100% ;float: left ;">
                                                <div style="color: #f2840d">等待客服回复...</div>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection