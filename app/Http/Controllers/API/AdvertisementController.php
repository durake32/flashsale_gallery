<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Advertisement1;
use App\Models\Advertisement2;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
  
      public function getAllAdvertisement(){
        $advertisement = Advertisement::get();
        $data['advertisement'] = $advertisement;
        $data['message'] = 'Advertisement List';
        return response()->json($data, 200);
       }
  
      public function getAdvertisement1(){
        $featured =  Advertisement1::get();
        $data['featured']=$featured;
        $data['message']='Advertisement List';
        return response()->json($data, 200);
      }
  
  
     public function getAdvertisement2(){
        $featured =  Advertisement2::get();
        $data['featured']=$featured;
        $data['message']='Advertisement List';
        return response()->json($data, 200);
    }
  
     public function getPopup(){
       
     }

}
