<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductList;
use App\Models\Product;
use App\Models\Review;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function search(Request $request) {
        $searchData = $request->input('name');
        // Search in the name and description columns from the posts table
        $products = Product::query()->where('status','=', 1)
            ->where('name', 'LIKE', "%{$searchData}%")
            ->orWhere('description', 'LIKE', "%{$searchData}%")
            ->orWhere('meta_description', 'LIKE', "%{$searchData}%")
            ->onlineProduct()
            ->with('brand')
            ->get();
        if(count($products)){
            return response()->json($products);
        }
        else
        {
            return response()->json(['Result' => 'No Data not found'], 404);
        }
    }

    public function getNewArrivals(){
        $newarrivals = Product::onlineProduct()->where('status', 1)
            ->latest()->take(12)->get();
        $data['newarrivals'] = $newarrivals;
        $data['message'] = 'New Arrivals List';
        return response()->json($data, 200);
    }

    public function getFeaturedProducts(){
        $featured = Product::onlineProduct()->where('status', 1)->where('is_featured', 1)
            ->take(12)->get();
        $data['featured'] = $featured;
        $data['message'] = 'Featured Product List';
        return response()->json($data, 200);
    }

    public function getSection1Products(){
        $section1 = Product::onlineProduct()->where('status', 1)
            ->where('section1', 1)->take(12)->get();
        $data['featured']=$section1;
        $data['message'] = 'Nepali Product List';
        return response()->json($data, 200);
    }

    public function getSection2Products(){
        $featured = Product::withCount('orderProducts')->onlineProduct()->where('status', 1)
                    ->orderBy('order_products_count','desc')->latest()->get();
        $data['featured'] = $featured;
        $data['message'] = 'Top Selling Product List';
        return response()->json($data, 200);
    }

    public function getForyouProducts(){
        $featured = Product::onlineProduct()->where('status', 1)
            ->where('is_foryou', 1)->latest()->paginate(20);
        $data['featured']=$featured;
        $data['message'] = 'For You Product List';
        return response()->json($data, 200);
    }

    public function productDetails($id){
      $productDetails = Product::with('brand')->find($id);
       $data['Product Details']= $productDetails;
        $similarProducts = Product::onlineProduct()->where('status', 1)
            ->where('sub_category_id', $productDetails->sub_category_id)
            ->where('id', '!=', $id)
            ->with('brand')
            ->latest()
            ->take(15)
            ->get();

        $data['Similar Products']= $similarProducts;
      	$reviewcount = Review::where('product_id',$productDetails->id)->with('user')->latest()->get();
        $data['Product Review ']= $reviewcount;
	   $avarage = Review::where('product_id',$productDetails->id)->avg('rating') ?? "0";
       $data['Product Avarage']= $avarage;
       return Response()->json($data, 200);
    }

    public function newAllproduct(){
        $allnewProducts =  Product::onlineProduct()->where('status', 1)
                ->with('brand')->latest()->get();
        $data['All New Products'] = $allnewProducts;
        return Response()->json($data, 200);
    }

    public function allFeaturedProducts(){
        $featured = Product::onlineProduct()->where('status', 1)
            ->where('is_featured', 1)->latest()->get();
        $data['All featured Product'] = $featured;
        return response()->json($data, 200);
    }

    public function allSection1Products(){
        $section1 = Product::onlineProduct()->where('status', 1)
            ->where('section1', 1)->latest()->get();
        $data['Nepali Product List']=$section1;
        return response()->json($data, 200);
    }

    public function allSection2Products(){
        $featured = Product::withCount('orderProducts')->onlineProduct()->where('status', 1)
                    ->orderBy('order_products_count','desc')->latest()->get();
        $data['Top Selling Product List'] = $featured;
        return response()->json($data, 200);
    }

    public function allForyouProducts(){
        $featured = Product::onlineProduct()->where('status', 1)
            ->where('is_foryou', 1)->latest()->paginate(10);
        $data['For You Product List']= $featured;
        return response()->json($data, 200);
    }

    public function allFlashProducts(){
        $setting = SiteSetting::find(1);
        $today = today();
        if($setting->enable_flash_sale && $today->isBetween($setting->sale_from, $setting->sale_to)){
            $flash_products = Product::onlineProduct()->where('status',1)
            ->where('is_discount',1)->whereNotNull('discount_amount')->latest()->get();
        }else{
            $flash_products = [];
        }
        return response()->json([
            'message' => 'Flash Product List',
            'total' => count($flash_products) ?? 0,
            'data' => ProductList::collection($flash_products)
        ], 200);
    }

    public function allBrandProducts($id)
    {
       $products = Product::onlineProduct()->where('status', 1)
           ->where('brand_id', '=', $id)
            ->with('brand')
             ->latest()
            ->get();
       $data['Brand Wise Product List']= $products;
        return response()->json($data, 200);
    }

    public function allCategoryProducts($id)
    {
        $products = Product::onlineProduct()->where('status', 1)
           ->where('category_id', '=', $id)
            ->with('brand')
             ->latest()
            ->get();
        $data['Category Wise Product List']= $products;
        return response()->json($data, 200);
    }


    public function allSubCategoryProducts($id)
    {
       $products = Product::onlineProduct()->where('status', 1)
           ->where('sub_category_id', '=', $id)
            ->with('brand')
            ->latest()
            ->get();
       $data['SubCategory Wise Product List']= $products;
        return response()->json($data, 200);
    }

}