@extends('Home.common')

@section('common')
<!--注册样式-->
<div class="Inside_pages clearfix">
    <div class="register">
        <div class="register_style">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="u_register">
                    <ul>
                        <li class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="name">用户名称：</label>
                            <input id="name" type="text"  class="text_Add" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <p class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </p>
                            @endif
                        </li>
                        <li class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="name">用户邮箱：</label>
                            <input id="email" type="text"  class="text_Add" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <p class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                        </li>
                        <li class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="name">设置密码：</label>
                            <input id="password" type="password"  class="text_Add" placeholder="6-20个字符，由字母、数字和符号组成" name="password" required>
                            @if ($errors->has('password'))
                                <p class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </p>
                            @endif
                        </li>
                        <li class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="name">确认密码：</label>
                            <input id="password_confirmation" type="password"  class="text_Add" name="password_confirmation" required>
                        </li>
                    </ul>
                <div class="auto-register">
                    <label class="auto-label">
                        <input type="checkbox" id="rememberMe">
                        <span><a href="#">《国际商贸城网站注册协议》</a></span>
                    </label>
                </div>
                <div class="register-btn">
                    <button type="submit" class="btn_register" style="outline: none;border: 0;">注&nbsp;&nbsp;&nbsp;&nbsp;册</button>
                </div>
            </div>
            </form>
        </div>
        <div class="register_img"><img src="/image/home/Register_img.png" style="width:650px ;height: 452px;"/></div>
    </div>
</div>
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Register</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" method="POST" action="{{ route('register') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
