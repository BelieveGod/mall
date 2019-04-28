<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductComment extends Common
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

    /**
     * 计算评价的条数
     * @param $product_id
     * @param $feel
     * @return int
     */
    public static function counthaoping($product_id ,$feel)
    {
        $arr =  ProductComment::where(['product_id'=>$product_id,'haoping'=>$feel])->select([DB::raw('count(*) as num')])->groupBy('product_id')->first();
        if($arr){
            return $arr->num;
        }
        return 0;
    }

    /**
     * 根据用户id输出用户的所有评论
     * @param $user_id
     * @return array
     */
    public static function findCommentByUserId($user_id)
    {
        $comment = ProductComment::where('menber_id' , $user_id)->orderBy('created_at','desc')->get()->toArray();
        //数据处理
        $data = [];
        foreach ($comment as $value){
            foreach ($value as $k=>$v){
//                if($k == 'comment_pic'){
//                    $value['comment_pic'] = json_decode($v);
//                }
                if($k == 'product_id'){
                    $value['pro'] = Product::where('product_id' , $v)->first()->toArray();
                }
                if($k == 'product_form_id'){
                    $value['order'] = ProductForm::where('form_id' , $v)->first()->toArray();
                }
            }
            $data[] = $value;
        }
        return $data;
    }

    public static function findCommentByProductId($product_id)
    {
        $comment = ProductComment::where('product_id' , $product_id)->orderBy('created_at','desc')->get()->toArray();
        //数据处理
        $data = [];
        foreach ($comment as $value){
            foreach ($value as $k=>$v){
                if($k == 'menber_id'){
                    $menber = Member::where('users_id' , $v)->first();
                    $user = User::where('id' , $v)->first();
                    if(empty($user)){
                        $value['user'] = '';
                    }else{
                        $value['user'] = $user->toArray();
                    }
                    if(empty($menber)){
                        $value['menber'] = '';
                    }else{
                        $value['menber'] = $menber->toArray();
                    }
                }
//                if($k == 'comment_pic'){
//                    $value['comment_pic'] = json_decode($v);
//                }
            }
            $data[] = $value;
        }
        return $data;
    }

    public function getCommentPicAttribute($pictures)
    {
        return json_decode($pictures, true);
    }
}
