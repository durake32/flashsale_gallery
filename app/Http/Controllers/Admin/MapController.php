<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Map;
class MapController extends Controller
{
    public function edit()
    {
        return view('Dashboard.Admin.Map.edit',[
            "map"=>Map::first(),
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $map=Map::findOrfail($id);
        $map->link = $data['link'];
        $map->save();
        return redirect()->back()->withMessage('Successfully Updated');
    }
}