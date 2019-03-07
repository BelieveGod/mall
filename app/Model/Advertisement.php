<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    //
    protected $table = 'advertisement';
    protected $primaryKey = 'ad_id';

    const TIMING_LANTERN_SLIDE = 1; //上面定时幻灯片
    const FAN_STYLE = 2 ; //中间扇形幻灯片
    const LANTERN_SLIDE = 3; //最下面幻灯片

    public static function advertisementUsed()
    {
        return [
            self::TIMING_LANTERN_SLIDE => '上面定时幻灯片',
            self::FAN_STYLE => '中间扇形幻灯片',
            self::LANTERN_SLIDE => '最下面幻灯片',
        ];
    }
}
