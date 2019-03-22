<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Suggest extends Common
{
    //
    protected $table = 'suggest';
    protected $primaryKey = 'suggest_id';

    const SUGGEST = 1; //建议
    const PROBLEM = 2; //问题
    const REPORT = 3; //举报

    public static function suggestType()
    {
        return [
            self::SUGGEST => '建议',
            self::PROBLEM => '问题',
            self::REPORT => '举报',
        ];
    }

}
