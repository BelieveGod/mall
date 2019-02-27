<?php

namespace App\Model;

class Member extends Common
{
    protected $table = 'member';
    protected $primaryKey = 'member_id';
    protected $dates = ['member_birth'];

    const MEMBER_SEX_MAN = 0; //男
    const MEMBER_SEX_WOMEN = 1; //女

    /**
     * 用户性别
     */
    public static function getMemberSexList()
    {
        return [
            self::MEMBER_SEX_MAN => '男',
            self::MEMBER_SEX_WOMEN => '女'
        ];
    }

}
