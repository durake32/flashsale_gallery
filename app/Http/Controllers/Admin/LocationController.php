<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->get();
        return view('Dashboard.Admin.locations.index',compact('locations'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
        ]);
        Location::create([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
        ]);
        return redirect()->route('admin.locations.index')->with('success','Location Added Successfully');
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|string',
        ]);
        $cate = Location::findOrFail($id);
        $cate->update([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
        ]);
        return redirect()->route('admin.locations.index')->with('success','Location updated Successfully');
        
    }

    public function destroy($id)
    {
        Location::findOrFail($id)->delete();
        return redirect()->route('admin.locations.index')->with('success','Location deleted Successfully');
    }
}
