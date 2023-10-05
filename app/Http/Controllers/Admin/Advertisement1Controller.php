<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement1;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class Advertisement1Controller extends Controller
{
    public function index()
    {
        $advertisements = Advertisement1::all();
        return view('Dashboard.Admin.advertisement1.index',compact('advertisements'));
    }
    public function create()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::onlineProduct()->where('status',1)->latest()->get();
        return view('Dashboard.Admin.advertisement1.create',compact('categories','subcategories','brands','products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            "url"=>"required",
            "title"=>"required|max:60",
        ]);
       $advertisement=Advertisement1::create($request->all());
        if($request->hasFile('url'))
        {
            if($request->file('url')){
                $file= $request->file('url');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move('Asset/Uploads/advertisements1', $filename);
                $advertisement->url= $filename;
                $advertisement->type = $request->type;
                $advertisement->type_id = $request->type_id;
                $advertisement->save();
            }
        }
        return redirect()->route('admin.advertisement1.index')->withMessage('SuccessFull');
    }
    public function edit($id)
    {
        $advertisement = Advertisement1::findOrFail($id);
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::onlineProduct()->where('status',1)->latest()->get();
        return view('Dashboard.Admin.advertisement1.edit',compact('advertisement','categories','subcategories','brands','products'));
    }

    public function update(Request $request,$id)
    {
        $advertisement = Advertisement1::findOrFail($id);
        if($request->hasFile('url'))
        {
            $destination='Asset/Uploads/advertisements1'.$advertisement->url;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
        }
        if($request->file('url')){
            $file= $request->file('url');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move('Asset/Uploads/advertisements1', $filename);
            $advertisement->url= $filename;
            $advertisement->title = $request->title;
            $advertisement->type = $request->type;

            $advertisement->type_id = $request->type_id;
            $advertisement->save();
        }
      
        return redirect()->route('admin.advertisement1.index')->withMessage('Updated SuccessFull');
    }

    public function destroy($id)
    {
        $advertisement = Advertisement1::findOrFail($id);
        $advertisement->delete();
        return redirect()->route('admin.advertisement1.index')->withMessage('Deleted SuccessFull');
    }
}