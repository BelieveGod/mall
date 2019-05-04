<?php

namespace App\Http\Controllers;


use App\Model\Category;
use App\Model\Product;
use App\Model\ProductComment;
use App\Model\ProductForm;

class ProductDetailedController extends HomeController
{
    //
    public function detailed($id)
    {
        //查出该商品的对应类型的销量前5个商品
        $topProduct = Product::findProductTypeSalesVolumeTop($id , 5);
        //查出对应商品的详情页
        $product = Product::findProductById($id);

        //对去除来的 商品 数据进行处理
        foreach ($product as $key=>$value){
            switch ($key){
                case 'about_product':
                    //处理 产品详情 这个字段 为不破坏样式最多只能显示9个
                    $about_product = $product['about_product'];
                    if(empty($about_product)){
                        $product[$key] = [];
                        break;
                    }
                    foreach ($about_product as $k=>$v){
                        $temp[$k] = explode(',' , $v);
                    }
                    $about_product = array_combine($temp['attr_name'] , $temp['data']);
                    $about_product = array_slice($about_product , 0 , 9);
                    $product[$key] = $about_product;
                    break;
                case 'category_top_id':
                    //查看顶级名称
                    $category_top_id = $product['category_top_id'];
                    $category_top = Category::where('category_id' , $category_top_id)->first()->toArray();
                    $product[$key] = $category_top;
                    break;
            }
        }
//        dd($product);
        //查看评论详情
        $comment = ProductComment::findCommentByProductId($id);
//        dd($comment);
        //计算好评、中评、差评的数量
        $haoping = ProductComment::counthaoping($id , ProductComment::HAOPING);
        $zhongping = ProductComment::counthaoping($id , ProductComment::ZHONGPING);
        $chaping = ProductComment::counthaoping($id , ProductComment::CHAPING);
        $fenmu = $haoping+$zhongping+$chaping;
        if($fenmu){
            $haopingdu = round($haoping/$fenmu*100);
        }else{
            $haopingdu = 100;
        }


        return view('Home.productDetailed',
            [
                'topProduct' => $topProduct,
                'product' => $product,
                'comment' => $comment,
                'haoping' => $haoping,
                'zhongping' => $zhongping,
                'chaping' => $chaping,
                'haopingdu' => $haopingdu,
            ]);
    }
}