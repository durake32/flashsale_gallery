<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Advertisement;
use App\Models\Advertisement1;
use App\Models\Advertisement2;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SiteSetting;
use Auth;

use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function index()
    {
        $subCategories = SubCategory::where('status', 1)
            ->where('is_featured', 1)
            ->select('id','name', 'image', 'slug', 'status', 'is_featured', 'category_id')
            ->get()
            ->take(8);

        $banners = Banner::select('title', 'description', 'image', 'slug', 'status','url')->where('status', 1)->get();

        $brands = Brand::where('status', 1)
            ->select('id', 'name', 'image', 'slug', 'status', 'is_featured')
            ->where('is_featured', 1)
            ->with(
                [
                    'products' => function ($products) {
                        $products->where('status', 1);
                    },

                ]
            )
            ->get();

        $featuredProducts = Product::onlineProduct()->where('status', 1)
            ->where('is_featured', 1)->take(12)->latest()->get();
        //new arrival products
        $newProducts = Product::onlineProduct()->where('status', 1)
            ->latest()->take(12)->get();

        $justForYou = Product::onlineProduct()->where('status', 1)
            ->where('is_foryou', 1)->inRandomOrder()->take(18)->latest()->get();
        //nepali product
        $section1 = Product::onlineProduct()->where('status', 1)
            ->where('section1', 1)->take(12)->latest()->get();
        //top selling product
        $section2 = Product::withCount('orderProducts')->onlineProduct()->where('status', 1)
                    ->take(12)->orderBy('order_products_count','desc')->get();
        //flash products
        $setting = SiteSetting::find(1);
        $today = today();
        $flash_products = null;
        if($setting->enable_flash_sale && $today->isBetween($setting->sale_from, $setting->sale_to)){
            $flash_products = Product::onlineProduct()->where('status',1)
            ->where('is_discount',1)->whereNotNull('discount_amount')->take(12)->latest()->get();
        }
        
        $topCategories = SubCategory::where('status', 1)
            ->where('is_featured', 1)
             ->select('id', 'name', 'image', 'slug', 'status', 'is_featured')
            ->get()
            ->sortByDesc('created_at');
        $advertisements = Advertisement::all();
        $advertisements1 = Advertisement1::all();
        $sectionFeatured = Advertisement2::all();

        if (Auth::check()){
            $userId = auth()->user()->id;
            $cartCollection = \Cart::session($userId)->getContent();
        } else {
            $cartCollection = '';
        }

        $siteSetting=SiteSetting::first();
        return view('Frontend.Home.index', compact(
            'subCategories',
            'brands',
            'featuredProducts',
            'newProducts',
            'banners',
            'justForYou',
            'section1',
            'section2',
            'topCategories',
            'advertisements',
            'siteSetting'
            ,'advertisements1',
            'sectionFeatured',
           'cartCollection','flash_products'
        ));
    }

    public function fetchSubCategory(Request $request){
        $data['subcategories'] = SubCategory::where("category_id", $request->category_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }

}
