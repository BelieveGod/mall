<?php

namespace App\Model;

class Member extends Common
{
    protected $table = 'member';
    protected $primaryKey = 'member_id';
//    protected $dates = ['member_birth'];
    protected $fillable = ['users_id','member_name','member_sex','member_tel','member_birth','blacklist','vip','member_pic'];

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

    public static function findMemberNameById()
    {
        return Member::pluck('member_name' , 'member_id')->toArray();
    }

    //home
    public static function findUserInfoByUserId($user_id)
    {
        return Member::where('users_id' , $user_id)->first();
    }

}
