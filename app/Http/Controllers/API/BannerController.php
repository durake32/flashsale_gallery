<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function getBanners(){
        $banners = Banner::where('status', 1)->limit(5)->get();
        $data['banner']=$banners;
        $data['message']='Banner List';
        return response()->json($data, 200);
    }
}
