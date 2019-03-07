<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use App\Admin\Extensions\Form\AttrValueBtn;
use App\Admin\Extensions\Form\Sku;
use App\Admin\Extensions\Form\UEditor;
use App\Admin\Extensions\Form\GaodeMap;
use App\Admin\Extensions\Form\BusinessAddressBtn;
use App\Admin\Extensions\Form\UploadImg;
use Encore\Admin\Form;

Encore\Admin\Form::forget(['map', 'editor']);

Form::extend('attrvaluebtn', AttrValueBtn::class);//类似一对多
Form::extend('sku', Sku::class);//sku按钮
Form::extend('ueditor', UEditor::class);//输入文本
Form::extend('gaodemap' , GaodeMap::class);//接入高德地图
Form::extend('businessaddress' , BusinessAddressBtn::class);//商家地址选择
Form::extend('uploadImg' , UploadImg::class);//图片上传按钮
