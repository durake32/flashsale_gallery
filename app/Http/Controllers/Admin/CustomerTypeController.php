<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    public function index()
    {
        $types = CustomerType::get();
        return view('Dashboard.Admin.Customer.customer_type.index',compact('types'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
        ]);
        CustomerType::create([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
        ]);
        return redirect()->route('admin.customer_types.index')->with('success','CustomerType Added Successfully');
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|string',
        ]);
        $cate = CustomerType::findOrFail($id);
        $cate->update([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
        ]);
        return redirect()->route('admin.customer_types.index')->with('success','CustomerType updated Successfully');
        
    }

    public function destroy($id)
    {
        CustomerType::findOrFail($id)->delete();
        return redirect()->route('admin.customer_types.index')->with('success','CustomerType deleted Successfully');
    }
}
