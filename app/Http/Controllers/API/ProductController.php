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

        return response()->json([
            'message' => 'Search Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
    }

    public function getNewArrivals(){
        $products = Product::onlineProduct()->where('status', 1)
            ->latest()->take(12)->get();
        
        return response()->json([
            'message' => 'New Arrivals Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
    }

    public function getFeaturedProducts(){
        $products = Product::onlineProduct()->where('status', 1)->where('is_featured', 1)
            ->take(12)->get();
        return response()->json([
            'message' => 'Featured Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);    
    }

    public function getSection1Products(){
        $products = Product::onlineProduct()->where('status', 1)
            ->where('section1', 1)->take(12)->get();
        return response()->json([
            'message' => 'Nepali Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
       
    }

    public function getSection2Products(){
        $products = Product::withCount('orderProducts')->onlineProduct()->where('status', 1)
                    ->orderBy('order_products_count','desc')->latest()->get();
        return response()->json([
            'message' => 'Top Selling Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
    }

    public function getForyouProducts(){
        $products = Product::onlineProduct()->where('status', 1)
            ->where('is_foryou', 1)->inRandomOrder()->latest()->paginate(20);
        
        return ProductList::collection($products);
    }

    public function productDetails($id){
        $product = Product::with('brand')->find($id);
        $similarProducts = Product::onlineProduct()->where('status', 1)
            ->where('sub_category_id', $product->sub_category_id)
            ->where('id', '!=', $id)
            ->latest()
            ->take(15)
            ->get();
        $review = Review::where('product_id',$product->id)->with('user')->latest()->get();
        $average =  Review::where('product_id',$product->id)->avg('rating') ?? "0";

        return response()->json([
            'message' => 'Product Details with Similar Product and ProductAverage',
            'total' => 1,
            'data' => [
                'product_details' => new ProductList($product),
                'similar_products' => ProductList::collection($similarProducts),
                'product_reviews' => $review,
                'product_average' =>  $average,
            ],
        ], 200);
    }

    public function newAllproduct(){
        $products =  Product::onlineProduct()->where('status', 1)
                ->with('brand')->latest()->get();
        return response()->json([
            'message' => 'New Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
    
    }

    public function allFeaturedProducts(){
        $products = Product::onlineProduct()->where('status', 1)
            ->where('is_featured', 1)->latest()->get();
        return response()->json([
            'message' => 'Featured Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
    }

    public function allSection1Products(){
        $products = Product::onlineProduct()->where('status', 1)
            ->where('section1', 1)->latest()->get();
        return response()->json([
            'message' => 'Nepali Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
    }

    public function allSection2Products(){
         $products = Product::withCount('orderProducts')->onlineProduct()->where('status', 1)
                    ->orderBy('order_products_count','desc')->latest()->get();
        return response()->json([
            'message' => 'Top Selling Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
    }

    public function allForyouProducts(){
        $products = Product::onlineProduct()->where('status', 1)
            ->where('is_foryou', 1)->inRandomOrder()->latest()->paginate(10);
        return response()->json([
            'message' => 'Featured Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
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
             ->latest()
            ->get();
        return response()->json([
            'message' => 'Brand Wise Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
    
    }

    public function allCategoryProducts($id)
    {
        $products = Product::onlineProduct()->where('status', 1)
           ->where('category_id', '=', $id)
             ->latest()
            ->get();
        return response()->json([
            'message' => 'Category Wise Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
       
    }

    public function allSubCategoryProducts($id)
    {
       $products = Product::onlineProduct()->where('status', 1)
           ->where('sub_category_id', '=', $id)
            ->latest()
            ->get();
        return response()->json([
            'message' => 'SubCategory Wise Product List',
            'total' => count($products) ?? 0,
            'data' => ProductList::collection($products)
        ], 200);
      
    }

}