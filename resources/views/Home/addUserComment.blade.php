@extends('Home.memberInfo')

@section('info')
    <div class="user_right">
        <div class="user_Borders">
            <div class="title_name">
                <span class="name">商品评价</span>
            </div>
            <div class="user_integral_style slideTxtBox">
                <div class="bd">
                </div>
                <div class="about_user_info">
                    <form id="form1" name="form1" method="post" action="/api/created_comment" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="call_user_layout">
                            @foreach($comment_list['pro'] as $value)
                            <ul >
                                <li style="border: 1px solid #ccc;width: 500px;padding: 10px;height: 50px;">
                                    <a class="user_title_name" href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}">
                                        <img src="/uploads/{{isset($value['product_master_img'][0])?$value['product_master_img'][0]:null}}" width="50" height="50" style="border-radius: 0;"/>
                                    </a>
                                    <p>
                                        <a href="/productDetailed/{{isset($value['product_id'])?$value['product_id']:null}}" >{{isset($value['product_name'])?$value['product_name']:null}}</a>
                                        <p style="margin-top: 10px;">产地：<span>{{isset($value['product_origin'])?$value['product_origin']:null}}</span></p>
                                    </p>
                                </li>
                                <li>
                                    <label class="user_title_name">评价：</label>
                                    <select class="add_text" name="haoping[]">
                                        {{--<option >请选择评价</option>--}}
                                        <option value="3">好评</option>
                                        <option value="2">中评</option>
                                        <option value="1">差评</option>
                                    </select>
                                </li>
                                <li style="height: 100px">
                                    <label class="user_title_name">商品评价：</label>
                                    <textarea style="height: 100px;width: 400px; border: 1px solid #ddd; padding: 10px 10px;" name="comment[]" placeholder="请输入商品评价"></textarea>
                                </li>
                                {{--<li>--}}
                                    {{--<label class="user_title_name">晒图 ：</label>--}}
                                    {{--<label for="business_pic" style="background: #F60;color: #fff;padding: 8px;font-size: 16px;border-radius: 3px;cursor:pointer;">上传图片</label>--}}
                                    {{--<input type="file" id="business_pic" style="display:none" name="business_pic" onchange="uploadFile(this)"/>--}}
                                    {{--<span></span>--}}
                                {{--</li>--}}

                                <li style="border-bottom: 1px solid #ccc;width: 800px;"></li>
                                <input type="hidden" name="product_id[]" value="{{isset($value['product_id'])?$value['product_id']:null}}" />
                            </ul>
                            @endforeach
                                <div style="margin-bottom: 150px;">
                                    <label class="user_title_name">晒图 ：</label>
                                    <label for="business_pic" style="background: #F60;color: #fff;padding: 8px;font-size: 16px;border-radius: 3px;cursor:pointer;">上传图片</label>
                                    <input type="file" id="business_pic" style="display:none" name="business_pic" onchange="uploadFile(this)" accept = "image/*"/>
                                    <p style="margin-top: 30px;"></p>
                                </div>
                                <input type="hidden" name="menber_id" value="{{Auth::id()}}"/>
                                <input type="hidden" name="product_form_id" value="{{$comment_list['form_id']}}" />
                                <input  type="hidden" name="store_id" value="{{$comment_list['store_id']}}"/>
                            <div class="operating_btn">
                                <button name="up" type="submit" class="submit—btn">提&nbsp;&nbsp;&nbsp;交</button>
                            </div>
                        </div>
                    </form>
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
                        url : '/api/user_comment_uploadImg',
                        data :formData,
                        cache : false,
                        processData : false,
                        contentType : false,
                        success : function(response){
                            var html = '<div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">\n' +
                                '<div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;line-height: 20px;\n' +
                                'color: #fff;text-align:center;right: 3px;top: 3px;cursor:pointer;" onclick="removeImg(this)">X</div>\n' +
                                '<img src="'+ response +'" width="80" height="80"/>\n' +
                                '<input type="hidden" value="'+response+'" name="comment_pic[]">\n' +
                                '</div>';
                            $(obj).parent().find('p').append(html);
                        },
                        error : function(){ }
                    });

                }
                function removeImg(obj)
                {
                    var del = $(obj).parent().find('input').val();
                    var data = {};
                    data.del = del;

                    $.get('/api/user_comment_deletedImg' , data , function (res) {
                        if(res){
                            $(obj).parent().remove();
                            console.log(res);
                        }
                    });

                }
            </script>

        </div>
    </div>
@endsection