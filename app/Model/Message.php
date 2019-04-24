<?php

namespace App\Model;

class Message extends Common
{
    //
    protected $table = 'message';
    protected $primaryKey = 'message_id';

    public static function findAllMessage($id)
    {
        return Message::where('topic_id' , $id)->orderBy('message_id' , 'desc')->get();
    }

}
