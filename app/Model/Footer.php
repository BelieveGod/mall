<?php

namespace App\Model;

class Footer extends Common
{
    protected $table='footer';
    protected $primaryKey = 'footer_id';

    const DISPLAY = 1; //显示
    const UN_DISPLAY = 0; //不显示

    //admin 获取Footer的上级目录
    public static function findFooterNameByPid()
    {
        $data = [];
        $root = Footer::where('pid','0')->pluck('footer_name','footer_id')->toArray();
        foreach ($root as $key => $value){
            $data[$key] = $value;
            $parents = Footer::where([['pid',$key] , ['is_show' , self::DISPLAY]])->orderBy('sort')->pluck('footer_name','footer_id')->toArray();
            foreach ($parents as $key1 => $value1){
                $data[$key1] = '&nbsp;&nbsp;&nbsp;&nbsp;'.$value1;
                $child =  Footer::where([['pid',$key1] , ['is_show' , self::DISPLAY]])->orderBy('sort')->pluck('footer_name','footer_id')->toArray();
                foreach ($child as $key2 => $value2){
                    $data[$key2] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value2;
                }
            }
        }
        return $data;
    }

    //home 获取Footer的所有要显示的值
    public static function findFooterToHome()
    {
        $parents = Footer::where('pid' , '1')->get();

        $data = [];
        foreach ($parents as $value)
        {
            $temp = [];
            $temp['parents'] = $value->footer_name;
            $child = Footer::where([['pid',$value->footer_id ] , ['is_show' , self::DISPLAY]])
                ->orderBy('sort')->pluck('footer_name' , 'footer_id')->toArray();
            $temp['child'] = $child;
            $data[] = $temp;
        }
        return $data;
    }
}
