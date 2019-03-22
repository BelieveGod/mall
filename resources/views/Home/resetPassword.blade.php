@extends('Home.memberInfo')

@section('info')
    {{--@if(!empty($errors) && count($errors) > 0 )    --}}
{{--      <div id="errors"> --}}
{{--        错误信息：{{ $errors->all()}}--}}
{{--      </div>--}}
{{--   @endif  --}}

<div class="user_right">
    <div class="user_Borders">
        <div class="title_name">
            <span class="name">修改密码</span>
        </div>
        <div class="about_user_info">
            <form id="form1" name="form1" method="post" action="/api/postReset">
                {{--@if(count($errors) > 0)--}}
                    {{--<div class="mark">--}}
                        {{--@foreach($errors->all() as $error)--}}
                            {{--<li style="color: red">{{ $error }}</li>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--@endif--}}

                @if(count($errors) > 0)
                    <div class="alert alert-danger display-hide" style="display: block;">
                        <button class="close" data-close="alert"></button>
                        <span> {{$errors->first()}}  </span>
                    </div>
                @endif

                {{ csrf_field() }}
                <div class="user_layout">
                    <ul >
                        <li>
                            <label class="user_title_name">原密码：</label>
                            <input name="oldpassword" type="password" autocomplete="off"  class="add_text" placeholder="原密码"/>
                        </li>

                        <li>
                            <label class="user_title_name">新密码：</label>
                            <input name="password" type="password" autocomplete="off"  class="add_text" placeholder="新密码"/>
                        </li>
                        <li>
                            <label class="user_title_name">确认新密码：</label>
                            <input name="password_confirmation" type="password"  autocomplete="off" class="add_text" placeholder="确认新密码"/>
                        </li>
                    </ul>
                    <div class="operating_btn">
                        <button name="up" type="submit" class="submit—btn">提&nbsp;&nbsp;&nbsp;交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection