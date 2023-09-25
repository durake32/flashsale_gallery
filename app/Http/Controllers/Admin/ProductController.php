<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProduct;
use App\Http\Requests\Product\UpdateProduct;
use App\Models\Product;
use App\Models\Retailer;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $products = Product::with(['brand','category','sub_category','retailer','reviews'])
            ->latest()->paginate(10);
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $products = Product::with(['brand','category','sub_category','retailer','reviews'])
              ->where('retailer_id', $retailerID)->latest()->paginate(10);
        }
        return view('Dashboard.Admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $brands = Brand::select('id', 'name')->get();
        $retailers = Retailer::select('id', 'name')->get();
        $categories = Category::select('id','name')->get();
        $subCategories = SubCategory::select('id','name')->get();

        return view('Dashboard.Admin.Product.create', compact('product', 'brands', 'retailers','categories','subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $segment = $request->segment(1);

        if ($segment == 'admin') {
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:products',
                'brand_id' => 'required|integer',
                'is_featured' => 'required|boolean',
                'is_foryou' => 'required|boolean',
                'section1' => 'required|boolean',
                 'section2' => 'required|boolean',
                'regular_price' => 'required|integer',
                'category_id' => 'required|integer',
                'sub_category_id' => 'required|integer',
                'sale_price' => 'nullable|integer',
                'wholesaler_price' => 'nullable|integer',
                'allowed_quantity' => 'nullable|integer',
                'retailer_id' => 'required|integer',
                'description' => 'required|string|max:2000000',
                'additional_information' => 'nullable|string|max:2000000',
                'meta_description' => 'nullable|string|max:200',
                'main_image' => 'nullable|image',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required|boolean',
                'product_type' => 'required|string',
            ]);
        } elseif ($segment == 'retailer') {
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:products',
                'brand_id' => 'required|integer',
                'is_featured' => 'required|boolean',
                'is_foryou' => 'required|boolean',
                 'section1' => 'required|boolean',
                'section2' => 'required|boolean',
                'category_id' => 'required|integer',
                'sub_category_id' => 'required|integer',
                'regular_price' => 'required|integer',
                'sale_price' => 'nullable|integer',
                'wholesaler_price' => 'nullable|integer',
                'allowed_quantity' => 'nullable|integer',
                'description' => 'required|string|max:2000000',
                'additional_information' => 'nullable|string|max:2000000',
                'meta_description' => 'nullable|string|max:200',
                'main_image' => 'nullable|image',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required|boolean',
                'product_type' => 'required|string',

            ]);
        }

        if (Auth::guard('admin')->check()) {
            $retailerID = $request->retailer_id;
        } elseif (Auth::guard('retailer')->check()) {
            $retailer = Retailer::findOrFail(Auth::guard('retailer')->id());
            $retailerID = $retailer->id;
        }

        $brandID = $request->brand_id;

        $product['name'] = $request->name;
        $product['brand_id'] = $brandID;
        $product['category_id'] = $request->category_id;
        $product['sub_category_id'] = $request->sub_category_id;
        $product['is_featured'] = $request->input('is_featured');
        $product['is_foryou'] = $request->input('is_foryou');
        $product['section1'] = $request->input('section1');
        $product['section2'] = $request->input('section2');
        $product['regular_price'] = $request->regular_price;
        $product['sale_price'] = $request->sale_price;
        $product['wholesaler_price'] = $request->wholesaler_price;
        $product['allowed_quantity'] = $request->allowed_quantity;
        $product['retailer_id'] = $retailerID;
        $product['description'] = $request->description;
        $product['additional_information'] = $request->additional_information;
        $product['meta_description'] = $request->meta_description;
        $product['status'] = $request->status;
        $product['product_type'] = $request->product_type;
        $product['best'] = $request->best;
        $product['latest'] = $request->latest;
        $product['trending'] = $request->trending;
        $product['is_discount'] = $request->input('discount_amount') > 0 ? 1 : 0;
        $product['discount_amount'] = $request->discount_amount;

        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $originalImageName = uniqid() . '-' . "500x500" . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 500)->save('Asset/Uploads/Products/' . $originalImageName);
            $product['main_image'] = $originalImageName;
        }

        if ($request->hasfile('image')) {
            $images = $request->image;
            foreach ($images as $image) {
                $originalImageName = uniqid() . '-' . "500x500" . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(500, 500)->save('Asset/Uploads/Products/' . $originalImageName);
                $originalImage[] = $originalImageName;
            }

            $product['image'] = json_encode($originalImage);
        }

        $product->save();

        return redirect(route($segment . '.' . 'product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function productWiseReviews($id)
    {
        if (Auth::guard('admin')->check()) {
            $productReviews = Product::where('id', $id)->with('reviews')->firstOrFail();
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $productReviews = Product::where('id', $id)->where('retailer_id', $retailerID)->with('reviews')->firstOrFail();
        }
        return view('Dashboard/Admin/Product-Wise-Reviews.index', compact('productReviews'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::select('id', 'name')->get();
        $retailers = Retailer::select('id', 'name')->get();
        $categories = Category::select('id','name')->get();
        $subCategories = SubCategory::select('id','name')->get();
        return view('Dashboard.Admin.Product.edit', compact('product', 'brands', 'retailers','categories','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $segment = $request->segment(1);
        $product = Product::findOrFail($id);
        if ($segment == 'admin') {
            $this->validate($request, [
                'name' => 'required', 'string', 'max:255', 'unique:products,' . $product->name,
                'brand_id' => 'required', 'integer',
                 'is_featured' => 'required', 'boolean',
                 'is_foryou' => 'required|boolean',
                 'section1' => 'required|boolean',
                'section2' => 'required|boolean',
                'category_id' => 'required|integer',
                'sub_category_id' => 'required|integer',
                'regular_price' => 'required', 'integer',
                'sale_price' => 'nullable', 'integer',
                'wholesaler_price' => 'nullable', 'integer',
                'allowed_quantity' => 'nullable', 'integer',
                'retailer_id' => 'required', 'integer',
                'description' => 'required', 'string', 'max:2000000',
                'additional_information' => 'nullable', 'string', 'max:2000000',
                'meta_description' => 'nullable|string|max:200',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required', 'boolean',
                'product_type' => 'required',
                'product_type' => 'required|string',

            ]);
        } elseif ($segment == 'retailer') {
            $this->validate($request, [
                'name' => 'required', 'string', 'max:255', 'unique:products,' . $product->name,
                'brand_id' => 'required', 'integer',
                'is_featured' => 'required', 'boolean',
                 'is_foryou' => 'required|boolean',
                 'section1' => 'required|boolean',
                'section2' => 'required|boolean',
                'category_id' => 'required|integer',
                'sub_category_id' => 'required|integer',
                'regular_price' => 'required', 'integer',
                'sale_price' => 'nullable', 'integer',
                'wholesaler_price' => 'nullable', 'integer',
                'allowed_quantity' => 'nullable', 'integer',
                'description' => 'required', 'string', 'max:2000000',
                'additional_information' => 'nullable', 'string', 'max:2000000',
                'meta_description' => 'nullable|string|max:200',
                'image' => 'nullable',
                'image.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:10048',
                'status' => 'required', 'boolean',
                'product_type' => 'required|string',
            ]);
        }

        if (Auth::guard('admin')->check()) {
            $retailerID = $request->input('retailer_id');
        } elseif (Auth::guard('retailer')->check()) {
            $retailer = Retailer::findOrFail(Auth::guard('retailer')->id());
            $retailerID = $retailer->id;
        }

        $brandID = $request->input('brand_id');
        $product->name = $request->input('name');
        $product->brand_id = $brandID;
        $product['category_id'] = $request->category_id;
        $product['sub_category_id'] = $request->sub_category_id;
        $product->is_featured = $request->input('is_featured');
        $product->is_foryou = $request->input('is_foryou');
        $product->section1 = $request->input('section1');
        $product->section2 = $request->input('section2');
        $product->regular_price = $request->input('regular_price');
        $product->sale_price = $request->input('sale_price');
        $product->wholesaler_price = $request->input('wholesaler_price');
        $product->allowed_quantity = $request->input('allowed_quantity');
        $product->retailer_id = $retailerID;
        $product->description = $request->input('description');
        $product->additional_information = $request->input('additional_information');
        $product->meta_description = $request->input('meta_description');
        $product->status = $request->input('status');
        $product->product_type = $request->product_type;
        $product->best = $request->input('best');
        $product->latest = $request->input('latest');
        $product->trending = $request->input('trending');
        $product->is_discount = $request->input('discount_amount') > 0 ? 1 : 0;
        $product->discount_amount = $request->input('discount_amount');

        if ($request->hasFile('image')) {
            // $images = explode(",", $product->image);
            if ($product->image) {
                $images = json_decode($product->image);
                foreach ($images as $image) {
                    $existingImage = 'Asset/Uploads/Products/' . $image;
                    if (file_exists($existingImage)) {
@unlink($existingImage);
                    }
                }
            }

            $images = $request->image;
            foreach ($images as $image) {
                $originalImageName = uniqid() . '-' . "500x500" . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(500, 500)
                    ->save('Asset/Uploads/Products/' . $originalImageName);
                $originalImage[] = $originalImageName;
                $product->image = json_encode($originalImage);
            }
        }

        if ($request->hasFile('main_image')) {
            $existingImage = 'Asset/Uploads/Products/' . $product->main_image;
            if (file_exists($existingImage)) {
@unlink($existingImage);
            }

            $originalImage = $request->file('main_image');
            $extension = $originalImage->getClientOriginalExtension();

            $defaultImage = Image::make($originalImage);

            $originalPath = 'Asset/Uploads/Products/';

            $originalImageName = uniqid() . '-' . "500x500";

            $defaultImage->resize(500, 500);
            $defaultImage->save($originalPath . $originalImageName . '.' . $extension);

            $originalImageName = $originalImageName . '.' . $extension;

            $product->main_image = $originalImageName;
        }


        $product->save();

        return redirect(route($segment . '.' . 'product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        dd($product->id);
        $segment = $request->segment(1);
        $mainImagePath = 'Asset/Uploads/Products/' . $product->main_image;

        if (file_exists($mainImagePath)) {
@unlink($mainImagePath);
        }


        if ($product->image) {
            $images = json_decode($product->image);
            foreach ($images as $image) {
                $imagePath = 'Asset/Uploads/Products/' . $image;
                if (file_exists($imagePath)) {
@unlink($imagePath);
                }
            }
        }

        $product->delete();

        // return redirect(route($segment . '.' . 'product.index'));
        return redirect()->back();
    }
    public function destroyProduct(Request $request, Product $product)
    {
        $segment = $request->segment(1);
        $mainImagePath = 'Asset/Uploads/Products/' . $product->main_image;

        if (file_exists($mainImagePath)) {
@unlink($mainImagePath);
        }


        if ($product->image) {
            $images = json_decode($product->image);
            foreach ($images as $image) {
                $imagePath = 'Asset/Uploads/Products/' . $image;
                if (file_exists($imagePath)) {
@unlink($imagePath);
                }
            }
        }

        $product->delete();
        return redirect()->back();
    }
}