<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Image as ModelsImage;
use Illuminate\Http\Request;
use Image;

class GalleryController extends Controller
{
    public function index()
    {
        $categories = Gallery::get();
        return view('Dashboard.Admin.gallery.images.index',compact('categories'));
    }

    public function create(){
        return view('Dashboard.Admin.gallery.images.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string'
        ]);
        $gallery = Gallery::create([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
        ]);
        if ($request->hasfile('image')) {
            $request_images = $request->image;
            foreach ($request_images as $req_image) {
                $originalImageName = uniqid() . '-' . "500x500" . '.' . $req_image->getClientOriginalExtension();
                Image::make($req_image)->resize(500, 500)->save('Asset/Uploads/Gallery/' . $originalImageName);
                $imagedata = new ModelsImage();
                $imagedata->image = $originalImageName;
                $gallery->images()->save($imagedata);
            }
        }
        return redirect()->route('admin.gallery.index')->with('success','Category Added Successfully');
    }

    public function show($id){
    }

    public function edit($id)
    {
        $cate = Gallery::findOrFail($id);
        return view('Dashboard.Admin.gallery.images.edit',compact('cate'));
    }
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|string'
        ]);
        $gallery = Gallery::findOrFail($id);
        $gallery->update([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
        ]);
        if ($request->hasfile('image')) {
            $request_images = $request->image;
            //remove all category old images
            if($gallery->images()->count() > 0) {
                foreach($gallery->images as $image){
                    $existingImage = 'Asset/Uploads/Gallery/' . $image->image;
                    if (file_exists($existingImage)) {
                        @unlink($existingImage);
                    }
                    $gallery->images()->delete($image);
                }
            }
            foreach ($request_images as $req_image) {
                $originalImageName = uniqid() . '-' . "500x500" . '.' . $req_image->getClientOriginalExtension();
                Image::make($req_image)->resize(500, 500)->save('Asset/Uploads/Gallery/' . $originalImageName);
                $imagedata = new ModelsImage();
                $imagedata->image = $originalImageName;
                $gallery->images()->save($imagedata);
            }
        }
        return redirect()->route('admin.gallery.index')->with('success','Category updated Successfully');
        
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if($gallery->images()->count() > 0) {
            foreach($gallery->images as $image){
                $existingImage = 'Asset/Uploads/Gallery/' . $image->image;
                if (file_exists($existingImage)) {
                    @unlink($existingImage);
                }
                $gallery->images()->delete($image);
            }
        }
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success','Category deleted Successfully');
    }

    public function removeGalleryImage($galleryImage){

        $image = ModelsImage::findOrFail($galleryImage);
        $mainImagePath = 'Asset/Uploads/Gallery/' . $image->image;

        if (file_exists($mainImagePath)) {
            @unlink($mainImagePath);
        }

        $image->delete();
        return back();
    }
}
