<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\File;


class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements=Advertisement::latest()->get();
        return view('Dashboard.Admin.advertisement.index',compact('advertisements'));
    }
    public function create()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::onlineProduct()->where('status',1)->latest()->get();
        return view('Dashboard.Admin.advertisement.create',compact('categories','subcategories','brands','products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "url"=>"required",
            "title"=>"required|max:60",
        ]);
       $advertisement=Advertisement::create([
            'title' => $request->title,
            'url' => $request->url,
            'type' => $request->type,
            'type_id' => $request->type_id,
            'link' => $request->link,
       ]);
        if($request->hasFile('url'))
        {
            if($request->file('url')){
                $file= $request->file('url');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move('Asset/Uploads/advertisements', $filename);
                $advertisement->url= $filename;
                $advertisement->type = $request->type;
                $advertisement->type_id = $request->type_id;
                $advertisement->save();
            }

        }
        return redirect()->route('admin.advertisement.index')->withMessage('Created SuccessFull');
    }

    public function edit(Advertisement $advertisement)
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::onlineProduct()->where('status',1)->latest()->get();
        return view('Dashboard.Admin.advertisement.edit',compact('advertisement','categories','subcategories','brands','products'));

    }
    public function update(Request $request,Advertisement $advertisement)
    {
        if($request->hasFile('url'))
        {
            $destination='Asset/Uploads/advertisements'.$advertisement->url;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
        }
            $advertisement->update($request->all());
            if($request->file('url')){
                $file= $request->file('url');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move('Asset/Uploads/advertisements', $filename);
                $advertisement->url= $filename;
                $advertisement->type = $request->type;
                $advertisement->type_id = $request->type_id;
                $advertisement->save();
            }
        return redirect()->route('admin.advertisement.index')->withMessage('Updated SuccessFull');

    }

    public function destroy($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();
        return redirect()->route('admin.advertisement.index')->withMessage('Deleted SuccessFull');
    }
}