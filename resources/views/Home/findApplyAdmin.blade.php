@extends('Home.common')

@section('common')
    <div class="call_Inside_pages clearfix" style='background-image: url("/image/home/call_us.jpg");
    background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%; margin-bottom: 100px;'>
        <div class="clearfix user" style="">
            <div class="call_user_right"style="background: rgba(255,255,255,0.6);">
                <div class="user_Borders" style="min-height: 450px">
                    <div class="title_name">
                        <span class="name">查看申请结果</span>
                        <a href="/applyAdmin" style="float:right">申请加入》</a>
                    </div>
                    <div class="about_user_info">
                        <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="call_user_layout">
                                <ul>
                                    <li>
                                        <label class="user_title_name">手机号：</label>
                                        <input type="text"  class="add_text" autocomplete="off" placeholder="请输入申请的手机号"  name="store_name" style="float: left"/>
                                        <div class="operating_btn" style="margin-left: 20px;float: left">
                                            <button name="up" type="submit" class="submit—btn" style="width: 100px; ">查询</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                        <table class="find_apply_admin">
                            <thead>
                                <td>申请id</td>
                                <td>申请人</td>
                                <td>申请人手机号</td>
                                <td>申请状态</td>
                            </thead>
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection