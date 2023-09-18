<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function getBrand(){
        $brands = Brand::where('status', 1)->get();
        $data['brand']=$brands;
        $data['message']='Brand List';
        return response()->json($data, 200);
    }
}
