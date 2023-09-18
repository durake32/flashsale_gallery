<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Validator;

class ProfileController extends Controller
{

    public function __construct() {
        $this->middleware('auth:delivery-api');
    }

    public function updateProfile(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, $validator->errors(), 422]);
        }
        $delivery = Delivery::find($id);
        $delivery->name = $request->name;
        $delivery->save();

        if($delivery){
            return response()->json(['status' => true, 'message' => 'Details updated successfully!']);
        }else{
          return response()->json(['status' => false, 'message' => 'Error']);
        }
    }



    public function updateProfileImage(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, $validator->errors(), 422]);
        }
        $delivery = Delivery::find($id);
        $random = Str::random(10);
        if($request->hasFile('image')){
            $image_temp = $request->file('image');
            if($image_temp->isValid()){
                $extension = $image_temp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $image_path = 'uploads/delivery/profile/'.$filename;
                Image::make($image_temp)->resize(100, 100)->save($image_path);
                $delivery->image = $filename;
            }
        }
        $delivery->save();

        if($delivery){
            return response()->json(['status' => true, 'message' => 'Details updated successfully!', 'data' => $delivery]);
        }else{
          return response()->json(['status' => false, 'message' => 'Error']);
        }
    }


}