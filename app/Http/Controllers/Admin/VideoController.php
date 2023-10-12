<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Video;
use Illuminate\Http\Request;
use Image;

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
            'image' => 'nullable',
            'video_link' => 'required',
        ]);
        $video = Video::create([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
            'video_link' => $request->get('video_link'),
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalImageName = uniqid() . '-' . "500x500" . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 500)->save('Asset/Uploads/Video/' . $originalImageName);
            $video->update([
                'image' => $originalImageName,
            ]);
        }
        
        return redirect()->route('admin.video.index')->with('success','Video Added Successfully');
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'image' => 'nullable',
            'video_link' => 'required',
        ]);
        $video = Video::findOrFail($id);
        $video->update([
            'name' => $request->get('name'),
            'slug'  => Str::slug($request->get('name')),
            'video_link' => $request->get('video_link'),
        ]);
        if ($request->hasFile('image')) {
            $existingImage = 'Asset/Uploads/Video/' . $video->image;
            if (file_exists($existingImage)) {
                @unlink($existingImage);
            }

            $originalImage = $request->file('image');
            $extension = $originalImage->getClientOriginalExtension();

            $defaultImage = Image::make($originalImage);

            $originalPath = 'Asset/Uploads/Video/';

            $originalImageName = uniqid() . '-' . "500x500";

            $defaultImage->resize(500, 500);
            $defaultImage->save($originalPath . $originalImageName . '.' . $extension);

            $originalImageName = $originalImageName . '.' . $extension;
            $video->update([
                'image' => $originalImageName,
            ]);
        }
        return redirect()->route('admin.video.index')->with('success','Video updated Successfully');
        
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $mainImagePath = 'Asset/Uploads/Video/' . $video->image;
        if (file_exists($mainImagePath)) {
            @unlink($mainImagePath);
        }
        $video->delete();
        return redirect()->route('admin.video.index')->with('success','Video deleted Successfully');
    }

}
