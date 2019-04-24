<?php

namespace App\Model;

class Topic extends Common
{
    //
    protected $table = 'topic';
    protected $primaryKey = 'topic_id';

    const UP_TOPIC = 1;//提交
    const ALREADY_DONE = 2;//已经解决

    const BUY = 1;//求购
    const SELL = 2;//供应
    const MINE = 3;//我的

    public static function topicStatic()
    {
        return [
            self::UP_TOPIC => '',
            self::ALREADY_DONE => '已解决',
        ];
    }

    public static function topicType()
    {
        return [
            self::BUY => '求购',
            self::SELL => '供应',
            self::MINE => '我的',
        ];
    }

    /**
     * 查找所有求购信息
     * @return mixed
     */
    public static function findAllTopicList()
    {
        return Topic::orderBy('topic_id', 'desc')->paginate(10);
    }

    /**
     * 查找求购或供应
     * @param $topic_type
     * @return mixed
     */
    public static function findTopicListByType($topic_type)
    {
        return Topic::where('topic_type',$topic_type)->orderBy('topic_id', 'desc')->paginate(10);
    }

    /**
     * 查找某个用户的求购信息
     * @param $user_id
     * @return mixed
     */
    public static function findTopicListByUserId($user_id)
    {
        return Topic::where('user_id' , $user_id)->orderBy('topic_id' , 'desc')->paginate(10);
    }
}
