<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
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
}
