<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductComment extends Model
{
    protected $table = 'product_comment';
    protected $primaryKey = 'product_comment_id';

    const HAOPING = 3 ; //好评
    const ZHONGPING = 2 ; //中评
    const CHAPING = 1 ; //差评

    /**
     * 用户评价
     */
    public static function productCommentHaoping()
    {
        return [
            self::HAOPING => '好评',
            self::ZHONGPING => '中评',
            self::CHAPING => '差评'
        ];
    }

    public static function counthaoping($product_id ,$feel)
    {
        $arr =  ProductComment::where(['product_id'=>$product_id,'haoping'=>$feel])->select([DB::raw('count(*) as num')])->groupBy('product_id')->first();
        if($arr){
            return $arr->num;
        }
        return 0;
    }
}
