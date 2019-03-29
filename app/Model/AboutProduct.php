<?php

namespace App\Model;


class AboutProduct extends Common
{
    //
    protected $table = 'about_product';
    protected $primaryKey = 'about_product_id';

    public static function findAboutProductName()
    {
        return AboutProduct::pluck('name');
    }
}
