<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('Dashboard.Admin.gallery.videos.index',compact('videos'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'video_link' => 'required',
        ]);
        Video::create([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
            'video_link' => $request->get('video_link'),
        ]);
        return redirect()->route('admin.video.index')->with('success','Video Added Successfully');
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'video_link' => 'required',
        ]);
        $cate = Video::findOrFail($id);
        $cate->update([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
            'video_link' => $request->get('video_link'),
        ]);
        return redirect()->route('admin.video.index')->with('success','Video updated Successfully');
        
    }

    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return redirect()->route('admin.video.index')->with('success','Video deleted Successfully');
    }

}
