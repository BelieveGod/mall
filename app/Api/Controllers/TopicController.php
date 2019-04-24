<?php

namespace App\Api\Controllers;

use App\Model\Member;
use App\Model\Suggest;
use App\Model\Topic;
use Illuminate\Http\Request;

class TopicController
{
    //表单提交的信息
    public function updateTopicStatus(Request $request)
    {
        $status = $request->get('status');
        $topic_id = $request->get('topic_id');
        $topic = Topic::find($topic_id);
        $topic->status = $status;
        $topic->save();
        return '修改成功！';
    }


}
