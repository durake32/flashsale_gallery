<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PushNotification;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetailResource;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    public function userOrder() {
        $Orders = Order::orderType('customer_added')->where('user_id', '=', auth('api')->user()->id)->get();
        $data['orders']= OrderResource::collection($Orders);
        $data['message']='Order List';
        return response()->json($data, 200);
    }

    public function userOfflineOrder() {
        $Orders = Order::orderType('admin_added')->where('user_id', '=', auth('api')->user()->id)->get();
        $data['orders']= OrderResource::collection($Orders);
        $data['message']=' Offline Order List';
        return response()->json($data, 200);
    }

    public function Notification() {
        $notifications = PushNotification::where('created_at','>=',Carbon::now()->subdays(15))->orderBy('updated_at', 'desc')->get();
        $data['notifications']= $notifications;
        $data['message']='Notification List';
        return response()->json($data, 200);
    }


    public function orderDetails($random_id) {
        $Orders = Order::with('order_products')->where('random_id',$random_id)->orderBy('updated_at', 'desc')->get();
        $data['orders'] = OrderDetailResource::collection($Orders);
        $data['message'] = 'Order Details';
        return response()->json($data, 200);
    }

    public function allOrderProductList()
    {
        $Orders = Order::select('orders.random_id','order_products.product_name','order_products.quantity','orders.delivery_date')
                    ->join('order_products','order_products.order_id','=','orders.id')
                    ->where('user_id', '=', auth('api')->user()->id)
                    ->where('status', '=', 3)
                    ->get();
        $data['order_products']= $Orders;
        $data['message']='Order Product List';
        return response()->json($data, 200);
    }

    public function orderHistory() {
        $Orders = Order::where('user_id', '=', auth('api')->user()->id)->get();
        $data['orders']= OrderResource::collection($Orders);
        $data['message']='Order History';
        return response()->json($data, 200);
    }

    public function paymentHistory() {

        $Orders =  Order::where('user_id', '=', auth('api')->user()->id)
            ->where('payment_status', 1)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->orderBy('updated_at', 'desc')->get();
        $data['orders']= OrderResource::collection($Orders);
        $data['message']='Payment History';
        return response()->json($data, 200);
    }

    public function updateOrder(Request $request, $random_id){

        $order = Order::where('random_id', $random_id)
            ->with('order_products.user')
            ->with('order_products.product')
            ->firstOrFail();
        $data = $request->all();
        $this->validate($request,[
            'status'=>'required',
            'remark'=>'required|max:100'
        ]);
        $order->status = $request->status;
        $order->remark = $request->remark;
        $order->updated_at = Carbon::now();
        $order->save();
        $data['order']= $order;
        $data['message']='Order Details';
        return response()->json($data, 200);

    }

    public function checkOut(Request $request)
    {
        $paymentMethod = PaymentMethod::where('slug', 'cash-on-delivery')->firstOrFail();
        $paymentMethodID = $paymentMethod->id;
        $userId = $request->get('user_id');

        $order = Order::create([
            'user_id' => $userId,
            'user_type' => 'customer',
            'random_id' => random_int(1000,9999),
            'total_amount' => $request->get('total_amount'),
            'total_quantity' => $request->get('total_quantity'),
            'delivery_charge' => $request->get('delivery_charge'),
            'payment_id' => $paymentMethodID,
            'status' => Order::ORDER_COMPLETE,
            'order_date' => Carbon::now()->timezone('Asia/Kathmandu'),
            'payment_status' => Order::PAYMENT_PENDING,
        ]);

        $carts = $request['carts'];
        foreach ($carts as $data) {
            $OrderPro = new OrderProduct();
            $OrderPro->order_id = $order->id;
            $OrderPro->product_id = $data['product_id'];
            $OrderPro->product_image = 'Asset/Uploads/Products/'.$data['product_image'];
            $OrderPro->retailer_id = $data['retailer_id'];
            $OrderPro->product_name = $data['product_name'];
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $data['quantity'];
            $OrderPro->save();
        }

        $user = User::where('id', $userId)->firstOrFail();
        $user->update(
            [
                'address' => $request->get('address'),
                'contact_no' => $request->get('contact_no'),
            ]
        );

        $data['message']='Thank you for your shopping, Your product will be at your door step ASAP.';
        return response()->json($data, 200);

    }

    public function esewaCheckOut(Request $request)
    {
        $userId = $request->get('user_id');
        $order = Order::create([
            'user_id' => $userId,
            'user_type' => 'customer',
            'random_id' => random_int(1000,9999),
            'total_amount' => $request->get('total_amount'),
            'total_quantity' => $request->get('total_quantity'),
            'delivery_charge' => $request->get('delivery_charge'),
            'payment_id' => 1,
            'status' => Order::ORDER_COMPLETE,
            'order_date' => Carbon::now()->timezone('Asia/Kathmandu'),
            'payment_status' => Order::PAYMENT_PENDING,
        ]);

        $carts = $request['carts'];

        foreach ($carts as $data) {

            $OrderPro = new OrderProduct();
            $OrderPro->order_id = $order->id;
            $OrderPro->product_id = $data['product_id'];
            $OrderPro->product_image = 'Asset/Uploads/Products/'.$data['product_image'];
            $OrderPro->retailer_id = $data['retailer_id'];
            $OrderPro->product_name = $data['product_name'];
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $data['quantity'];
            $OrderPro->save();
        }

        $user = User::where('id', $userId)->firstOrFail();
        $user->update(
            [
                'address' => $request->address,
                'contact_no' => $request->contact_no,
            ]
        );

        $data['message']='Thank you for your shopping, Your product will be at your door step ASAP.';
        return response()->json($data, 200);

    }

}