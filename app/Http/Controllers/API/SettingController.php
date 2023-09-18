<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SettingController extends Controller
{
    public function getSetting(){
        $setting = SiteSetting::first();
        $data['setting']=$setting;
        $data['message']='Setting List';
        return response()->json($data, 200);
    }
  
   public function getdeliveryCharge(){
    $setting = SiteSetting::select('aplicable','charge','minimum_amount')->first();
    $data['Delivery Charge']=$setting;
    return response()->json($data, 200);
    }
  
  
   public function  getlastOrderId(){
    $orderid = DB::table('orders')->latest('random_id')->first('random_id') ?? 2300;
    $data['Last Order Id']= $orderid;
    return response()->json($data, 200);
   }
}