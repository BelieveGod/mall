<?php

namespace App\Http\Controllers;


use App\Model\Product;

class ProductDetailedController extends Controller
{
    //
    public function index($id)
    {
        $topProduct = Product::findProductTypeSalesVolumeTop($id , 5);
        $product = Product::findProductById($id);
//        dd($topProduct);
        return view('Home.productDetailed',
            [
                'topProduct' => $topProduct,
                'product' => $product,
            ]);
    }
}