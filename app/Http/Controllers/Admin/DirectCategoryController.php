<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectCategory;
use Illuminate\Support\Facades\File;

class DirectCategoryController extends Controller
{
    public function index()
    {
        $directCategories=DirectCategory::latest()->get();;
        return view('Dashboard.Admin.Direct-Category.index',compact('directCategories'));
    }
    public function create()
    {
      return view('Dashboard.Admin.Direct-Category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required|max:60",
        ]);
       $advertisement=DirectCategory::create($request->all());
        return redirect()->route('admin.directCategory.index')->withMessage('SuccessFull');
    }
    public function edit(DirectCategory $directCategory)
    {
        return view('Dashboard.Admin.Direct-Category.edit',compact('directCategory'));
    }

    public function update(Request $request,DirectCategory $directCategory)
    {
            $directCategory->update($request->all());
        return redirect()->route('admin.directCategory.index')->withMessage('SuccessFull');
    }
    public function destroy(DirectCategory $directCategory)
    {
       $directCategory->delete();
        return redirect()->back();
    }
}