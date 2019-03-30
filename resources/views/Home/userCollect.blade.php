@extends('Home.memberInfo')

@section('info')
<div class="user_right">
    <div class="user_Borders clearfix">
        <div class="title_name">
            <span class="name">用户收藏</span>
        </div>
        <!--收藏样式-->
        <div class="Collect">
            <ul class="Collect_list">
                @foreach($collect as $value)
                <li>
                    <div class="Collect_pro_name">
                        <a href="javascript:void(0);" class="delete_Collect" attr="{{$value['collect_id']}}"></a>
                        <p class="img center"><a href="/productDetailed/{{$value['product_id']}}">
                            <img src="/uploads/{{$value['product_master_img'][0]}}" /></a>
                        </p>
                        <p><a href="#">{{$value['product_name']}}</a></p>
                        <p class="Collect_Standard">礼盒装</p>
                        <p class="Collect_price">￥{{$value['present_price']}}<span style="font-size: 12px;">/{{$value['unit']}}</span></p>
                    </div>
                </li>
                @endforeach

            </ul>
            <!--分页-->
            {{$collect->links('Home.pagination.pages')}}
        </div>
        <script>
            $('.delete_Collect').click(function(){
                var del = $(this);
                var del_collect = del.attr('attr');
                var data = {};
                data.collect_id = del_collect;
                $.post('/api/delCollect' , data , function(res) {
                    alert(res);
                    if(res){
                        del.parent().parent().remove();
                    }
                });
            });
        </script>

    </div>
</div>
@endsection