<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Common extends Model
{
    //开启软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //时间以时间戳的形式保存
    protected $dateFormat = 'U';

    //时间修改器
    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i:s',$this->attributes['created_at']);
    }
    public function getUpdatedAtAttribute()
    {
        return date('Y-m-d H:i:s',$this->attributes['updated_at']);
    }

    //显示图片

}
