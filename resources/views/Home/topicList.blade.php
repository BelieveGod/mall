@extends('Home.common')

@section('common')
<div class="Bread_crumbs" >
    <div class="Inside_pages clearfix">
        <div class="left">当前位置：<a href="/home_index">首页</a>&gt;<a href="#">新鲜水果</a></div>
        <div class="right Search">
            <form>
                <input name="" type="text"  class="Search_Box"/>
                <input name="" type="button"  name="" class="Search_btn"/>
            </form>
        </div>
    </div>
</div>
<div class="comments" style="margin-bottom: 100px;">
    <ul class="topic_ul">
        <li><a href="/show_topic_list/1">求购</a></li>
        <li><a href="/show_topic_list/2">供应</a></li>
        <li><a href="/show_topic_list/3">我的</a></li>
    </ul>

    <div class="comment-wrap" >
        <div class="photo">
            <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('{{$member_pic}}')"></div>
        </div>

        <div class="comment-block" >
            <form method="post" action="/web/api/upTopic">
                {{csrf_field()}}
                <input type="hidden" value="{{Auth::id()}}" name="used_id">
                <textarea name="topic_dec" id="" cols="30" rows="3" placeholder="我要发布..." >{{ old('topic_dec') }}</textarea>
                @if ($errors->has('topic_dec'))
                    <span>
                        <strong style="color: #de3530">{{ $errors->first('topic_dec') }}</strong>
                    </span>
                @endif
                <div class="topic_button">
                    <div style="float: left;margin-right: 50px;font-size: 14px;">
                        <input type="radio" name="topic_type" class="gcs-radio" id="buy" value="1" checked/>求购
                        <label for="buy"></label>
                        <input type="radio" name="topic_type" class="gcs-radio" id="sell" value="2"/>供应
                        <label for="sell"></label>
                    </div>
                    <button type="submit" class="btn_topic">发布</button>
                </div>
            </form>
        </div>
    </div>

        @if($topic_list->count()==0)
            <div class="comment-wrap">
                <img src="/image/home/not_fount.jpg" />
            </div>
        @else
            @foreach($topic_list as $value)
            <div class="comment-wrap">
                <div class="photo">
                    <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('{{isset($value['user_pic'])?$value['user_pic']:'/image/home/tx.jpeg'}}')"></div>
                </div>
                <div class="comment-block" style="background-color: #f8ffe0">
                    <a href="/show_topic_detail/{{isset($value['topic_id'])?$value['topic_id']:null}}" >
                        <p class="comment-text">
                            【{{isset($value['topic_type'])?\App\Model\Topic::topicType()[$value['topic_type']]:null}}】{{isset($value['topic_dec'])?$value['topic_dec']:null}}
                        </p>
                    </a>
                    <div class="bottom-comment">
                        <div class="comment-date">{{$value['created_at']}}</div>

                        <ul class="comment-actions">
                            <div class="changeSuccessTopic">修改成功</div>
                            @if($value['user_id'] == Auth::id())
                                @if($value['status'] == 2)
                                    <li class="complain" style="float: left;line-height: 22px;">
                                        <input type="checkbox"  class="gcs-checkbox" id="yijingjiejue{{isset($value['topic_id'])?$value['topic_id']:null}}" topic_id="{{isset($value['topic_id'])?$value['topic_id']:null}}" onclick="changeStatus(this)" checked="true"/>已经解决
                                        <label for="yijingjiejue{{isset($value['topic_id'])?$value['topic_id']:null}}"></label>
                                    </li>
                                @else
                                    <li class="complain" style="float: left;line-height: 22px;">
                                        <input type="checkbox"  class="gcs-checkbox" id="yijingjiejue{{isset($value['topic_id'])?$value['topic_id']:null}}" topic_id="{{isset($value['topic_id'])?$value['topic_id']:null}}" onclick="changeStatus(this)" />已经解决
                                        <label for="yijingjiejue{{isset($value['topic_id'])?$value['topic_id']:null}}"></label>
                                    </li>
                                @endif
                            @else
                                @if($value['status'] == 2)
                                    <li class="complain" style="float: left">【已解决】</li>
                                @endif
                            @endif
                            <li class="reply">留言：{{isset($value['topic_follow'])?$value['topic_follow']:null}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            <!--分页-->
            {{$topic_list->links('Home.pagination.pages')}}

        @endif
</div>

    <script>
        function changeStatus(obj)
        {
            var data ={};

            var checked = $(obj).attr('checked');
            if(checked){
                data.status = 2;
            }else{
                data.status = 1;
            }
            data.topic_id = $(obj).attr('topic_id');
            console.log(data);
            $.get('/api/update_topic_status' , data , function(res){
                $(obj).parent().parent().find('.changeSuccessTopic').show().animate({bottom: '140px'}, 200).fadeOut(1000); //提示信息
                console.log(res);
            });
        }
    </script>


@endsection