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

    public function check(){
      return view('check');
    }

    public function index()
    {
        // $subCategories = SubCategory::select('name', 'slug')->latest()->get();

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
            ->where('is_featured', 1)
            ->select('id','name', 'main_image', 'image' ,'slug', 'status', 'sale_price', 'regular_price', 'is_featured', 'brand_id')
            ->take(12)
            ->latest()
            ->get();
        $newProducts = Product::onlineProduct()->where('status', 1)

            ->select('id','name', 'main_image','image' ,'slug', 'status', 'brand_id', 'sale_price', 'regular_price')
            ->latest()
            ->with('brand')
            ->take(12)
            ->get();

        $justForYou = Product::onlineProduct()->where('status', 1)
            ->where('is_foryou', 1)
            ->select('id','name','image','main_image', 'slug', 'status', 'brand_id', 'sale_price', 'regular_price')
            ->inRandomOrder()
            ->with('brand')
            ->take(18)
            ->get();
            // dd($justForYou);

        // dd($justForYou);
         $section1 = Product::onlineProduct()->where('status', 1)
            ->where('section1', 1)
            ->select('id','name','image','main_image', 'slug', 'status', 'brand_id', 'sale_price', 'regular_price')
            ->with('brand')
            ->take(12)
           ->latest()
            ->get();

          $section2 = Product::onlineProduct()->where('status', 1)
            ->where('section2', 1)
            ->select('id','name','image','main_image', 'slug', 'status', 'brand_id', 'sale_price', 'regular_price')
            ->with('brand')
            ->take(12)
            ->latest()
            ->get();

        $topCategories = SubCategory::where('status', 1)
            ->where('is_featured', 1)
             ->select('id', 'name', 'image', 'slug', 'status', 'is_featured')
            ->get()
            ->sortByDesc('created_at');
        $advertisements=Advertisement::all();
        $advertisements1=Advertisement1::all();
        $sectionFeatured=Advertisement2::all();



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
           'cartCollection'
        ));
    }

    public function fetchSubCategory(Request $request){
        $data['subcategories'] = SubCategory::where("category_id", $request->category_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }


}
