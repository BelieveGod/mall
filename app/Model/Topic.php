<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $table = 'topic';
    protected $primaryKey = 'topic_id';

    const HOT_TOPIC = 1; //热门话题
    const NEW_TOPIC = 2; //最新话题
    const RECOMMEND_TOPIC = 3 ; //推荐话题
    const ORDINARY_TOPIC = 4 ; //普通话题

    public static function topicStatic()
    {
        return [
            self::HOT_TOPIC => '热门话题',
            self::NEW_TOPIC => '最新话题',
            self::RECOMMEND_TOPIC => '推荐话题',
            self::ORDINARY_TOPIC => '普通话题',
        ];
    }
}
