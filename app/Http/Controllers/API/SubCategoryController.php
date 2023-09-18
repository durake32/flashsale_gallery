<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function getSubCategory(){
        $subcategories = SubCategory::where('status', 1)->get();
        $data['subcategory']=$subcategories;
        $data['message']='SubCategory List';
        return response()->json($data, 200);
    }
  
  
   public function getTopSubCategory(){
       $subcategories = SubCategory::where('status', 1)->where('is_featured', 1)->get();
        $data['subcategory']=$subcategories;
        $data['message']='TopSubCategory List';
        return response()->json($data, 200);
   }
}
