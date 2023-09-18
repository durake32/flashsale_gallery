<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUserResource;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetailResource;
use Illuminate\Support\Facades\Validator;

class DeliveryPersonController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth('admin_api')->attempt($validator->validated())) {
            return response()->json(['error' => 'The Email or password you entered is incorrect !!'], 401);
        }
        return $this->createNewToken($token);
    }

    public function refresh() {
        return $this->createNewToken(auth('admin_api')->refresh());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth('admin_api')->user()
        ]);
    }
    public function logout()
    {
        auth('admin_api')->logout();
        return response()->json(['message' => 'User successfully signed out'],200);
    }

    public function profileData()
    {
       $user = auth('admin_api')->user();
       $data['profile']=  new AdminUserResource($user);
       $data['delivered_orders']=  Order::where('assign_user_id', $user->id)->where('status',3)->count();
       $data['total_orders']=  Order::whereIn('status',[1,3,4,5])->where('assign_user_id', $user->id)->count();
       $data['message']='Profile Info';
       return response()->json($data, 200);
    }

    public function assignOrderLists()
    {
       $user = auth('admin_api')->user();
       $Orders = Order::whereIn('status',[1,4,5])->where('assign_user_id', $user->id)->orderBy('order_date','desc')->get();
       $data['orders']= OrderResource::collection($Orders);
       $data['total'] = $Orders->count();
       $data['message']='Assigned Order List';
       return response()->json($data, 200);
    }

    public function orderStatusWiseData($status)
    {
       $user = auth('admin_api')->user();
       $Orders = Order::where('assign_user_id', $user->id)->where('status',$status)->orderBy('delivery_date','desc')->get();
       $data['orders']= OrderResource::collection($Orders);
       $data['message']=' Order List';
       return response()->json($data, 200);
    }
    public function orderDetails($random_id) {
        $user = auth('admin_api')->user();
        $Orders = Order::with('order_products')
                ->where('assign_user_id', $user->id)
                ->where('random_id',$random_id)->orderBy('updated_at', 'desc')->get();
        $data['orders'] = OrderDetailResource::collection($Orders);
        $data['message'] = 'Order Details';
        return response()->json($data, 200);
    }

    public function updateOrder(Request $request, $random_id){
      
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = auth('admin_api')->user();
        $order = Order::where('random_id', $random_id)->where('assign_user_id', $user->id)->firstOrFail();
        $order->status = $request->status;
        $order->save();
        $data['order']= $order;
        $data['message']='Order Updated Successfully';
        return response()->json($data, 200);
    }

}