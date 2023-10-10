<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Gallery\ImageResource;
use App\Http\Resources\Gallery\VideoResource;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Advertisement;
use App\Models\Advertisement1;
use App\Models\Advertisement2;
use App\Models\Gallery;
use App\Models\Video;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome(){

        $categories = Category::where('status', 1)->get();
        $data['Category']=$categories;

        $subcategories = SubCategory::where('status', 1)->get();
        $data['Subcategory']=$subcategories;

        $topsubcategories = SubCategory::where('status', 1)->where('is_featured', 1)->get();
        $data['Top Subcategory']=$topsubcategories;

        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $data['Brands'] = $brands;

        $banners = Banner::where('status', 1)->get();
        $data['Sliders']=$banners;


        $newarrivals = Product::onlineProduct()->onlineProduct()->where('status', 1)
            ->with('brand')
            ->take(12)
           ->latest()
            ->get();
        $data['New arrivals']=$newarrivals;

       $featured = Product::onlineProduct()->onlineProduct()->where('status', 1)
            ->where('is_featured', 1)
            ->with('brand')
            ->take(12)
            ->latest()
            ->get();
        $data['Featured Product']=$featured;

       $section1 = Product::onlineProduct()->where('status', 1)
            ->where('section1', 1)
            ->with('brand')
            ->take(12)
            ->latest()
            ->get();
        $data['Section1'] = $section1;


       $section2 = Product::onlineProduct()->where('status', 1)
            ->where('section2', 1)
            ->with('brand')
            ->take(12)
            ->latest()
            ->get();
        $data['Section2'] = $section2;

       $forYou = Product::onlineProduct()->where('status', 1)
            ->where('is_foryou', 1)
            ->with('brand')
            ->take(12)->inRandomOrder()
            ->latest()
            ->get();
        $data['For You'] = $forYou;

        $advertisement = Advertisement::get();
        $data['All Advertisement'] = $advertisement;

        $advertisement1 =  Advertisement1::get();
        $data['Advertisement1']= $advertisement1;

        $advertisement2 =  Advertisement2::get();
        $data['Advertisement2']= $advertisement2;

        return response()->json($data, 200);
    }

    public function bannerDetails($id){
        $bannerDetails = Banner::find($id);

        if($bannerDetails){

            if(!empty($bannerDetails['type'] == 'category')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('category_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'category';
                    $data['typeId'] = $bannerDetails['type'];
                    return response()->json($data, 200);
                }else{
                    $data['type']= 'category';
                    $data['typeId'] = $bannerDetails['type_id'];
                    $data['data']= 'No Data Found';
                    return response()->json($data, 200);
                }
                return response()->json($data, 200);

            }elseif (!empty($bannerDetails['type'] == 'subcategory')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('sub_category_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'subcategory';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }else{
                    $data['data']= 'No Data Found';
                    $data['type']= 'subcategory';
                    $data['typeId'] = $bannerDetails['type'];
                    return response()->json($data, 200);
                }
            }elseif (!empty($bannerDetails['type'] == 'brand')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('brand_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'brand';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }else{
                    $data['data']= 'No Data Found';
                    $data['type']= 'brand';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }
            }

        }else{
            $data['data']= 'No Data Found';
            return response()->json($data, 200);
        }

    }

    public function advertismentDetails($id){
        $bannerDetails = Advertisement::find($id);

        if($bannerDetails){

            if(!empty($bannerDetails['type'] == 'category')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('category_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'category';
                    $data['typeId'] = $bannerDetails['type'];
                    return response()->json($data, 200);
                }else{
                    $data['type']= 'category';
                    $data['typeId'] = $bannerDetails['type_id'];
                    $data['data']= 'No Data Found';
                    return response()->json($data, 200);
                }
                return response()->json($data, 200);

            }elseif (!empty($bannerDetails['type'] == 'subcategory')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('sub_category_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'subcategory';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }else{
                    $data['data']= 'No Data Found';
                    $data['type']= 'subcategory';
                    $data['typeId'] = $bannerDetails['type'];
                    return response()->json($data, 200);
                }
            }elseif (!empty($bannerDetails['type'] == 'brand')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('brand_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'brand';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }else{
                    $data['data']= 'No Data Found';
                    $data['type']= 'brand';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }
            }

        }else{
            $data['data']= 'No Data Found';
            return response()->json($data, 200);
        }

    }

    public function advertisment1Details($id){
        $bannerDetails = Advertisement1::find($id);

        if($bannerDetails){

            if(!empty($bannerDetails['type'] == 'category')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('category_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'category';
                    $data['typeId'] = $bannerDetails['type'];
                    return response()->json($data, 200);
                }else{
                    $data['type']= 'category';
                    $data['typeId'] = $bannerDetails['type_id'];
                    $data['data']= 'No Data Found';
                    return response()->json($data, 200);
                }
                return response()->json($data, 200);

            }elseif (!empty($bannerDetails['type'] == 'subcategory')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('sub_category_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'subcategory';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }else{
                    $data['data']= 'No Data Found';
                    $data['type']= 'subcategory';
                    $data['typeId'] = $bannerDetails['type'];
                    return response()->json($data, 200);
                }
            }elseif (!empty($bannerDetails['type'] == 'brand')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('brand_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'brand';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }else{
                    $data['data']= 'No Data Found';
                    $data['type']= 'brand';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }
            }

        }else{
            $data['data']= 'No Data Found';
            return response()->json($data, 200);
        }

    }

    public function advertisment2Details($id){
        $bannerDetails = Advertisement2::find($id);

        if($bannerDetails){

            if(!empty($bannerDetails['type'] == 'category')){
                $products = Product::onlineProduct()->where('status', 1)
                        ->where('category_id', $bannerDetails->type_id)
                        ->with('brand')
                        ->latest()
                        ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'category';
                    $data['typeId'] = $bannerDetails['type'];
                    return response()->json($data, 200);
                }else{
                    $data['type']= 'category';
                    $data['typeId'] = $bannerDetails['type_id'];
                    $data['data']= 'No Data Found';
                    return response()->json($data, 200);
                }
                return response()->json($data, 200);

            }elseif (!empty($bannerDetails['type'] == 'subcategory')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('sub_category_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'subcategory';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }else{
                    $data['data']= 'No Data Found';
                    $data['type']= 'subcategory';
                    $data['typeId'] = $bannerDetails['type'];
                    return response()->json($data, 200);
                }
            }elseif (!empty($bannerDetails['type'] == 'brand')){
                $products = Product::onlineProduct()->where('status', 1)
                    ->where('brand_id', $bannerDetails->type_id)
                    ->with('brand')
                    ->latest()
                    ->get();
                if($products){
                    $data['data']= $products;
                    $data['type']= 'brand';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }else{
                    $data['data']= 'No Data Found';
                    $data['type']= 'brand';
                    $data['typeId'] = $bannerDetails['type_id'];
                    return response()->json($data, 200);
                }
            }
            }else{
                $data['data']= 'No Data Found';
                return response()->json($data, 200);
            }
    }

    public function galleryList(){
        $gallery = Gallery::latest()->get();
        return response()->json([
            'message' => 'Image Gallery List',
            'total' => $gallery->count() ?? 0,
            'data' => ImageResource::collection($gallery)
        ], 200);
    }

    public function videoList(){
        $videos = Video::latest()->get();
        return response()->json([
            'message' => 'Videos List',
            'total' => $videos->count() ?? 0,
            'data' => VideoResource::collection($videos)
        ], 200);
    }


}