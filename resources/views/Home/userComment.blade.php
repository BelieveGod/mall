@extends('Home.memberInfo')

@section('info')
    <div class="user_right">
        <div class="user_Borders">
            <div class="title_name">
                <span class="name">我的评论</span>
            </div>
            <div class="user_integral_style slideTxtBox">

                <div class="bd">
                    <div class="tab-con">
                        @if(!empty($comment))
                        @foreach($comment as $value)
                        <div class="comment-item">
                            <div class="user-column">
                                <div class="user-info">
                                    订单号：<p>{{isset($value['order']['form_num'])?$value['order']['form_num']:null}}</p>
                                </div>
                                <div class="user-level">
                                    <a href="/productDetailed/{{isset($value['product']['product_id'])?$value['product']['product_id']:null}}">
                                        <img src="/uploads/{{isset($value['product']['product_master_img'][0])?$value['product']['product_master_img'][0]:null}}" width="60" height="60" style="border-radius: 30px;"/>
                                    </a>

                                    <p><a href="/productDetailed/{{isset($value['product']['product_id'])?$value['product']['product_id']:null}}" >{{$value['product']['product_name']}}</a></p>
                                </div>
                            </div>
                            <div class="comment-column J-comment-column" style="padding-left: 300px;">
                                <div class="comment-star star{{isset($value['haoping'])?$value['haoping']:null}}"></div>
                                {{--<div class="">好评</div>--}}
                                <p class="comment-con">
                                    {{$value['comment']}}
                                </p>
                                <div class="pic-list" style="margin-bottom: 50px;">
                                    @if(!empty($value['comment_pic']))
                                        @foreach($value['comment_pic'] as $val)
                                            <a class="J-thumb-img">
                                                <img src="{{$val}}" width="48" height="48"/>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="cursor-small" style="display: none">
                                    <img src="/image/test/1.jpg" width="50%" />
                                </div>
                                <div class="comment-message">
                                    <div class="order-info">
                                        <span>{{isset($value['created_at'])?$value['created_at']:null}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <div style="color: #8c8c8c;text-align: center;height: 200px;line-height: 200px;">暂无评论!</div>
                        @endif
                    </div>

                </div>
            </div>
            <script>jQuery(".slideTxtBox").slide({trigger:"click"});</script>
            <script>
                //评论 图片放大
                $(function(){
                    $('.tab-con').find('.comment-item').each(function(){
                        $(this).find('.pic-list').find('a').each(function(){
                            $(this).click(function(){
                                var src = $(this).find('img').attr('src');
                                // alert(src);
                                $(this).parent().find('a').removeClass('current');
                                $(this).addClass('current');
                                $(this).parent().next().css('display' , 'block');
                                $(this).parent().next().find('img').attr('src' , src);
                            });
                        });
                    });
                });
            </script>
        </div>
    </div>
@endsection