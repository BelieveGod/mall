@extends('Home.common')

@section('common')
    <div class="call_Inside_pages clearfix" style='background-image: url("/image/home/call_us.jpg");
    background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%; margin-bottom: 100px;'>
        <div class="clearfix user" style="">
            <div class="call_user_right"style="background: rgba(255,255,255,0.6);">
                <div class="user_Borders" style="min-height: 450px">
                    <div class="title_name">
                        <span class="name">申请加入我们</span>
                        <a href="/findApplyAdmin" style="float:right">查看申请结果》</a>
                    </div>
                    <div class="about_user_info">
                        <form id="form1" name="form1" method="post" action="/web/api/addApply" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="call_user_layout">
                                <ul style="width: 50% ;float: left">
                                    <li>
                                        <label class="user_title_name">商家昵称：</label>
                                        <input type="text" class="{{ $errors->has('business_nickname') ? ' add_text_denger' : 'add_text' }}" autocomplete="off" name="business_nickname" value="{{isset($store['business_nickname'])?$store['business_nickname']:null}}" placeholder="请输入昵称"/>
                                        @if ($errors->has('business_nickname'))
                                            <span>
                                                <strong style="color: #de3530">{{ $errors->first('business_nickname') }}</strong>
                                            </span>
                                        @endif
                                    </li>
                                    <li>
                                        <label class="user_title_name">店铺名称：</label>
                                        <input type="text"  class="{{ $errors->has('store_name') ? ' add_text_denger' : 'add_text' }}" autocomplete="off" placeholder="请输入店铺名称" value="{{isset($store['store_name'])?$store['store_name']:null}}" name="store_name"/>
                                        @if ($errors->has('store_name'))
                                            <span>
                                                <strong style="color: #de3530">{{ $errors->first('store_name') }}</strong>
                                            </span>
                                        @endif
                                    </li>
                                    <li>
                                        <label class="user_title_name">注册地址：</label>
                                        <input type="text"  class="{{ $errors->has('address') ? ' add_text_denger' : 'add_text' }}" autocomplete="off" placeholder="请输入注册的详细地址" value="{{isset($store['address'])?$store['address']:null}}" name="address"/>
                                        @if ($errors->has('address'))
                                            <span>
                                                <strong style="color: #de3530">{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </li>

                                </ul>
                                <ul style="width: 50%; float: left">

                                    <li>
                                        <label class="user_title_name">注册实名：</label>
                                        <input type="text"  class="{{ $errors->has('business_name') ? ' add_text_denger' : 'add_text' }}" placeholder="请输入真实姓名" name="business_name" value="{{isset($store['business_name'])?$store['business_name']:null}}" autocomplete="off"/>
                                        @if ($errors->has('business_name'))
                                            <span>
                                                <strong style="color: #de3530">{{ $errors->first('business_name') }}</strong>
                                            </span>
                                        @endif
                                    </li>
                                    <li>
                                        <label class="user_title_name">注册电话：</label>
                                        <input type="text"  class="{{ $errors->has('business_tel') ? ' add_text_denger' : 'add_text' }}" placeholder="请输入电话号码" name="business_tel" value="{{isset($store['business_tel'])?$store['business_tel']:null}}" autocomplete="off" disabled="disabled"/>
                                        @if ($errors->has('business_tel'))
                                            <span>
                                                <strong style="color: #de3530">{{ $errors->first('business_tel') }}</strong>
                                            </span>
                                        @endif
                                    </li>
                                    <li>
                                        <label class="user_title_name">身份证号码：</label>
                                        <input type="text"  class="{{ $errors->has('identity_card') ? ' add_text_denger' : 'add_text' }}" placeholder="请输入身份证号码" name="identity_card" value="{{isset($store['identity_card'])?$store['identity_card']:null}}" autocomplete="off"/>
                                        @if ($errors->has('identity_card'))
                                            <span>
                                                <strong style="color: #de3530">{{ $errors->first('identity_card') }}</strong>
                                            </span>
                                        @endif
                                    </li>

                                    <li>
                                        <label class="user_title_name">邮政编码：</label>
                                        <input type="text"  class="{{ $errors->has('post_num') ? ' add_text_denger' : 'add_text' }}" placeholder="请输入邮政编码" name="post_num" value="{{isset($store['post_num'])?$store['post_num']:null}}" autocomplete="off"/>
                                        @if ($errors->has('post_num'))
                                            <span>
                                                <strong style="color: #de3530">{{ $errors->first('post_num') }}</strong>
                                            </span>
                                        @endif
                                    </li>
                                    <li>
                                        <label class="user_title_name">实名照片：</label>
                                        <label for="business_pic" style="background: #F60;color: #fff;padding: 8px;font-size: 16px;border-radius: 3px;cursor:pointer;">上传图片</label>
                                        <input type="file" id="business_pic" style="display:none" name="business_pic" onchange="uploadFile(this)"/>

                                        <div style="color: #848484;margin-top: 10px;">*上传3张照片：身份证正面，身份证反面，手持身份证照片</div>
                                    </li>
                                    <li class="append-upload-img">
                                        <label class="user_title_name" style="width: 80px">&nbsp;</label>
                                        @if($store['business_pic'])
                                            @foreach($store['business_pic'] as $val)
                                            <div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">
                                                <div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;line-height: 20px;
                                                            color: #fff;text-align:center;right: 3px;top: 3px;cursor:pointer;" onclick="removeImg(this)">X</div>
                                                <img src="{{$val}}" width="80" height="80"/>
                                                <input type="hidden" value="{{$val}}" name="adminImg[]">
                                            </div>
                                            @endforeach
                                        @endif

                                        @if ($errors->has('adminImg'))
                                            <span>
                                                <strong style="color: #de3530">{{ $errors->first('adminImg') }}</strong>
                                            </span>
                                        @endif
                                    </li>
                                    <li>
                                    </li>
                                    <input type="hidden" value="{{isset($store['store_id'])?$store['store_id']:null}}" name="store_id"/>

                                </ul>
                                <div class="operating_btn">
                                    <button name="up" type="submit" class="submit—btn">提&nbsp;&nbsp;&nbsp;交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function uploadFile(obj)
        {
            var formData = new FormData();
            formData.append("img" , $(obj)[0].files[0]);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type : 'post',
                url : '/api/applyAdminUploadImg',
                data :formData,
                cache : false,
                processData : false,
                contentType : false,
                success : function(response){
                    var html = '<div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">\n' +
                                    '<div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;line-height: 20px;\n' +
                        'color: #fff;text-align:center;right: 3px;top: 3px;cursor:pointer;" onclick="removeImg(this)">X</div>\n' +
                        '<img src="'+ response +'" width="80" height="80"/>\n' +
                        '<input type="hidden" value="'+response+'" name="adminImg[]">\n' +
                        '</div>';
                    $('.append-upload-img').append(html);
                },
                error : function(){ }
            });
        }

        function removeImg(obj)
        {
            var del = $(obj).parent().find('input').val();
            var data = {};
            data.del = del;

            $.get('/api/applyAdminDeletedImg' , data , function (res) {
                if(res){
                    $(obj).parent().remove();
                    console.log(res);
                }
            });

        }
    </script>

@endsection