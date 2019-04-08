<?php

namespace App\Services\Common;

/**
 * 后台显示图片
 * Class ShowPicServices
 * @package App\Services\Common
 */
class ShowPicService
{
    public static function getlineimgs($imgIds)
    {
        $line = '';
        $imgArr = json_decode($imgIds, true);
        if (empty($imgIds) || empty($imgArr)) {
            return '暂无相关图片';
        }
        foreach ($imgArr as $id) {
            $url = '' . $id;
            $line .= "<a style='margin: 5px' target='_blank' href='{$url}'><img src='{$url}' width='120'  /></a>";
        }
        return $line;
    }
}