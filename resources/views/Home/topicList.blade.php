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



    <div class="comment-wrap">
        <div class="photo">
            <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('/image/test/2.jpg')"></div>
        </div>
        <div class="comment-block" style="background-color: #e5ffc5">
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum. Eligendi voluptatum ducimus architecto tempore, quaerat explicabo veniam fuga corporis totam reprehenderit
                quasi sapiente modi tempora at perspiciatis mollitia, dolores voluptate. Cumque, corrupti?</p>
            <div class="bottom-comment">
                <div class="comment-date">23.5 2014</div>
                <ul class="comment-actions">
                    <li class="complain">Complain</li>
                    <li class="reply">Reply</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="comment-wrap">
        <div class="photo">
            <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('/image/test/2.jpg')"></div>
        </div>
        <div class="comment-block" style="background-color: #e5ffc5">
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum. Eligendi voluptatum ducimus architecto tempore, quaerat explicabo veniam fuga corporis totam reprehenderit
                quasi sapiente modi tempora at perspiciatis mollitia, dolores voluptate. Cumque, corrupti?</p>
            <div class="bottom-comment">
                <div class="comment-date">23.5 2014</div>
                <ul class="comment-actions">
                    <li class="complain">Complain</li>
                    <li class="reply">Reply</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="comment-wrap">
        <div class="photo">
            <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('/image/test/2.jpg')"></div>
        </div>
        <div class="comment-block" style="background-color: #e5ffc5">
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum. Eligendi voluptatum ducimus architecto tempore, quaerat explicabo veniam fuga corporis totam reprehenderit
                quasi sapiente modi tempora at perspiciatis mollitia, dolores voluptate. Cumque, corrupti?</p>
            <div class="bottom-comment">
                <div class="comment-date">23.5 2014</div>
                <ul class="comment-actions">
                    <li class="complain">Complain</li>
                    <li class="reply">Reply</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="comment-wrap">
        <div class="photo">
            <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('/image/test/2.jpg')"></div>
        </div>
        <div class="comment-block" style="background-color: #e5ffc5">
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum. Eligendi voluptatum ducimus architecto tempore, quaerat explicabo veniam fuga corporis totam reprehenderit
                quasi sapiente modi tempora at perspiciatis mollitia, dolores voluptate. Cumque, corrupti?</p>
            <div class="bottom-comment">
                <div class="comment-date">23.5 2014</div>
                <ul class="comment-actions">
                    <li class="complain">Complain</li>
                    <li class="reply">Reply</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="comment-wrap" >
        <div class="photo">
            <div class="avatar" style="background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-image: url('/image/test/1.jpg')"></div>
        </div>
        <div class="comment-block" >
            <form action="">
                <textarea name="" id="" cols="30" rows="3" placeholder="我要求购..."></textarea>

                <div class="topic_button">
                    <button type="submit" class="btn_topic">提交</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--{{$product->links('Home.pagination.pages')}}--}}


@endsection