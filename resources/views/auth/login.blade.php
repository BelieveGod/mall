@extends('Home.common')

@section('common')
<div class="Inside_pages clearfix">
    <div class="login">
        <div class="style_login clearfix">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="layout">

                    <div class="login_title">登录</div>
                    <div class="item item-fore1 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="login-label name-label"></label>
                        <input id="email" type="email" class="form-control text" name="email" placeholder="请输入邮箱" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="item item-fore2 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="nloginpwd" class="login-label pwd-label"></label>
                        <input name="password" id="password" type="password" class="text form-control" placeholder="用户密码" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="auto-login">
                        <label class="auto-label">
                            <input type="checkbox" id="rememberMe" name="remember" {{ old('remember') ? 'checked' : '' }}><span>记住账号和密码</span>
                        </label>
                    </div>
                    <div class="login-btn">
                        <button type="submit" class="btn_login" style="outline: none;border: 0;">登&nbsp;&nbsp;&nbsp;&nbsp;录</button>
                    </div>
                    <div class="login_link"><a href="/register">免费注册</a> | <a href="{{ route('password.request') }}">忘记密码</a></div>
                </div>
            </form>
        </div>

        <div class="login_img"><img src="./image/test/4.jpg"  style="width: 600px;height: 442px;"/></div>
    </div>
</div>
@endsection
