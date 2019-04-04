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
                    <div class="about_user_info" id="findTheResult">
                        <form id="form1" name="form1" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="call_user_layout">
                                <ul>
                                    <li>
                                        <label class="user_title_name">手机号：</label>
                                        <input type="text"  class="add_text" autocomplete="off" placeholder="请输入申请的手机号"  name="store_name" style="float: left"/>
                                        <div class="operating_btn" style="margin-left: 20px;float: left">
                                            <button name="up" type="button" class="submit—btn" style="width: 100px; " onclick="findTell(this)">查询</button>
                                        </div>
                                    </li>
                                    {{--<li style="color: #848484;">无记录！</li>--}}
                                </ul>
                            </div>
                        </form>

                        <table class="find_apply_admin">

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function findTell(obj){
            var data = {};
            data.tel = $(obj).parent().parent().find('input').val();
            // console.log(data);
            $.get('/api/findTheResultByTel', data , function(res){
                if(res.length != 0){
                    var html = '';
                    html = '<thead>\n' +
                        '<td>申请人</td>\n' +
                        '<td>申请人手机号</td>\n' +
                        '<td>申请状态</td>\n' +
                        '<td>操作时间</td>\n' +
                        '<td>说明</td>\n' +
                        '<td>操作</td>\n' +
                        '</thead>'
                    for(var i=0 ; i<res.length ; i++){
                        html += '<tr>';
                        html += '<td>'+ res[i]['store']['business_name'] +'</td>\n' +
                            '<td>'+ res[i]['store']['business_tel'] +'</td>\n' +
                            '<td>'+ res[i]['action_status'] +'</td>\n' +
                            '<td>'+ res[i]['created_at'] +'</td>\n' +
                            '<td>'+ res[i]['memo'] +'</td>\n' ;
                        if(res[i]['action_status'] == '不通过' && res[i]['lock'] != 1){
                            html += '<td><a href="/updatedApplyAdmin/'+ res[i]['store_form_id'] +'">修改</a></td>';
                        }else{
                            html += '<td></td>';
                        }

                        html += '</tr>';
                    }
                    $('.wujilu').remove();
                    $('.find_apply_admin').find('tr').remove();
                    $('.find_apply_admin').append(html);
                    console.log(res);
                }else{
                    var html = '<li style="color: #848484;" class="wujilu">无记录！</li>';
                    $('.find_apply_admin').find('tr').remove();
                    $('#findTheResult').find('ul').append(html);
                }
            });
        };
    </script>


@endsection