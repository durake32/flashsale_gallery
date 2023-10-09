<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrand;
use App\Http\Requests\Brand\UpdateBrand;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with(['category','sub_category','products'])->latest()->get();

        return view('Dashboard.Admin.Brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Brand $brand)
    {
        return view('Dashboard.Admin.Brand.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrand $request, Brand $brand)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $brand['name'] = $request->name;
        $brand['is_featured'] = $request->is_featured;
        $brand['status'] = $request->status;

        $imageName = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $brand['image'] = $imageName . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('Asset/Uploads/Brands', $brand['image']);
        }

        $brand->save();

        return redirect(route($segment . '.' . 'brand.index'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('Dashboard.Admin.Brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrand $request, Brand $brand)
    {
        // dd($request->all());
        $segment = $request->segment(1);

        $brand->name = $request->input('name');
        $brand->is_featured = $request->input('is_featured');
        $brand->status = $request->input('status');

        $name = $request->input('name');

        if ($request->hasFile('image')) {

            $imageName = Str::slug($name);

            $existingImage = 'Asset/Uploads/Brands/' . $brand->image;

            if (file_exists($existingImage)) {
            @unlink($existingImage);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $imageName . '.' . $extension;
            $file->move('Asset/Uploads/Brands/', $fileName);
            $brand->image = $fileName;
        }

        $brand->save();

        return redirect(route($segment . '.' . 'brand.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        $segment = $request->segment(1);
        $imagePath = 'Asset/Uploads/Brands/' . $brand->image;

        if (file_exists($imagePath)) {
        @unlink($imagePath);
        }

        $brand->delete();

        return redirect(route($segment . '.' . 'brand.index'));
    }



    public function destroyBrand(Request $request,Brand $brand)
    {
        $segment = $request->segment(1);
        $imagePath = 'Asset/Uploads/Brands/' . $brand->image;

        if (file_exists($imagePath)) {
        @unlink($imagePath);
        }

        $brand->products()->delete(); // See below

        $brand->delete();

        return redirect(route($segment . '.' . 'brand.index'));
    }
}
