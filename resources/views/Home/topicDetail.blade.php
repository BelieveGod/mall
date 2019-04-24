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
        <li style="width: 50px;"><a href="/show_topic_list">&lt;&lt;返回</a></li>
    </ul>
    <div class="comment-wrap">
        <div class="photo">
            <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('{{isset($topic['user_pic'])?$topic['user_pic']:null}}')"></div>
        </div>
        <div class="comment-block" style="background-color: #f8ffe0">
                <p class="comment-text">
                    【{{isset($topic['topic_type'])?\App\Model\Topic::topicType()[$topic['topic_type']]:null}}】{{isset($topic['topic_dec'])?$topic['topic_dec']:null}}
                </p>
            <div class="bottom-comment">
                <div class="comment-date">{{isset($topic['created_at'])?$topic['created_at']:null}}</div>
            </div>
        </div>
    </div>

    @if(empty($message))
    <div class="comment-wrap" style="padding-left: 100px;">
        <img src="/image/home/not_ly.jpg" />
    </div>
    @else
        @if ($errors->has('reply'))
            <span style="float: right;">
                <strong style="color: #de3530">{{ $errors->first('reply') }}</strong>
            </span>
        @endif
        @foreach($message as $value)
        <div class="comment-wrap">
            <div class="photo">
                <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('{{isset($value['member']['member_pic'])?$value['member']['member_pic']:'/image/home/tx.jpeg'}}')"></div>
            </div>
            <div class="comment-block" style="background-color: #ffe2d6">
                <p class="comment-text">
                    【留言】{{$value['message']}}
                </p>
                <div class="bottom-comment">
                    <div class="comment-date">{{$value['created_at']}}</div>
                    @if($topic['user_id'] == Auth::id() && $value['reply']==null)
                        <ul class="comment-actions">
                            <li class="reply"><a href="javascript:void(0);" onclick="ReplyMessage(this)">回复</a></li>
                        </ul>
                    @elseif($value['reply']!=null)
                        <div class="reply-actions">
                            <p style="color: #848484">【回复】{{isset($value['reply'])?$value['reply']:null}}</p>
                            <p style="float: right">{{isset($value['updated_at'])?$value['updated_at']:null}}</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="comment-wrap" style="margin-top: 50px; display: none">
            <div class="photo">
                <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url({{$member_pic}})"></div>
            </div>
            <div class="comment-block" >
                <form method="post" action="/web/api/upReply">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$topic_id}}" name="topic_id">
                    <input type="hidden" value="{{isset($value['message_id'])?$value['message_id']:null}}" name="message_id">
                    <textarea name="reply" id="" cols="30" rows="3" placeholder="我要回复..." ></textarea>

                    <div class="topic_button">
                        <button type="submit" class="btn_topic">回复</button>
                    </div>
                </form>
            </div>
        </div>

        @endforeach
    @endif

    @if($topic['user_id'] != Auth::id())
    <div class="comment-wrap" style="margin-top: 50px;">
        <div class="photo">
            <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url({{$member_pic}})"></div>
        </div>

        <div class="comment-block" >
            <form method="post" action="/web/api/upMessage">
                {{csrf_field()}}
                <input type="hidden" value="{{Auth::id()}}" name="user_id">
                <input type="hidden" value="{{$topic_id}}" name="topic_id">
                <textarea name="message" id="" cols="30" rows="3" placeholder="我要留言..." ></textarea>
                @if ($errors->has('message'))
                    <span>
                        <strong style="color: #de3530">{{ $errors->first('message') }}</strong>
                    </span>
                @endif
                <div class="topic_button">
                    <button type="submit" class="btn_topic">留言</button>
                </div>
            </form>
        </div>
    </div>
    @endif


</div>

    <script>
        function ReplyMessage(obj)
        {
            $(obj).parents('.comment-wrap').next().css('display','block');
        }
    </script>
@endsection