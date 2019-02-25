<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form\GaodeMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaodeMapController extends Controller
{
    public function index(){
        $gps_name = \request('name');
        $gps_value = \request('value')?\request('value'):'';
        $GaodeKey = env('GAODE_MAPS_WS_API_KEY');
        return view('Admin.Form.gaodemap.gaodemap',compact('gps_name','GaodeKey','gps_value'));
    }
}
