<?php

namespace App\Model;

class Menu extends Common
{
    //
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';

    const DISPLAY = 1; //显示
    const UN_DISPLAY = 0; //不显示

    //home 查找要显示的目录
    public static function findMenuToHome()
    {
        return Menu::where('is_show',self::DISPLAY)->orderBy('sort')->get();
    }
}
