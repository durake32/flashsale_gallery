<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\DirectCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory(){
        $categories = Category::where('status', 1)->where('is_feature',1)->get();
        $data['category']=$categories;
        $data['message']='Category List';
      
        $subcategories = SubCategory::where('status', 1)->where('is_feature',1)->get();
        $data['subcategory']=$subcategories;
        $data['message']='SubCategory List'; 
      
        return response()->json($data, 200);

    }
  
      public function getScrapCategory(){
        $categories = DirectCategory::get();
        $data['direct category']= $categories;
        $data['message']='Direct Category List';
        return response()->json($data, 200);

    }
  
  
  
 
}
