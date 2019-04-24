<?php

namespace App\Http\Controllers;

use App\Model\Member;
use App\Model\Message;
use App\Model\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends HomeController
{
    public function index($id=0)
    {
        $user_id = Auth::user()->id;
        //获取个人信息
        $member_pic = $this->findMemberPicByUserId($user_id);

        //获取求购的信息
        if($id == 0){
            $topic_data = Topic::findAllTopicList();
        }else if($id == 3){
            $topic_data = Topic::findTopicListByUserId($user_id);
        }else{
            $topic_data = Topic::findTopicListByType($id);
        }
        return view('Home.topicList' , ['member_pic'=>$member_pic , 'topic_list' => $topic_data]);
    }

    public function topicDetail($id=0)
    {
        $user_id = Auth::user()->id;
        //获取个人信息
        $member_pic = $this->findMemberPicByUserId($user_id);

        $message = Message::findAllMessage($id)->toArray();
        $topic = Topic::where('topic_id' , $id)->first()->toArray();
        //数据处理
        $massage_plus = [];
        if($message){
            foreach ($message as $value){
                foreach ($value as $k=>$v){
                    if($k == 'user_id'){
                        $member = Member::where('users_id' , $v)->first();
                        $value['member'] = $member?$member->toArray():[];
                    }
                }
                $massage_plus[] = $value;
            }
        }

        return view('Home.topicDetail' , ['member_pic'=>$member_pic , 'message'=>$massage_plus , 'topic_id'=>$id , 'topic'=>$topic]);
    }

    protected function findMemberPicByUserId($user_id)
    {
        $member = Member::where('users_id' , $user_id)->first();
        $member_pic = isset($member->member_pic)?$member->member_pic:'/image/home/tx.jpeg';
        return $member_pic;
    }


}