<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Admin;
use App\Models\Esewa;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\PlaceOrder;
use App\Http\Requests\Order\ProceedToPay;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Retailer;
use App\Models\User;
use App\Models\SiteSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  public function cod(Request $request){

         $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId); // or any string represents user identifier

         $totalAmount = \Cart::getTotal();

        $totalQuantity = \Cart::getTotalQuantity();

        // Generates random order id for order
        $lastorderId = Order::orderBy('id', 'desc')->first()->random_id ?? 2300;
        // Generates random order id for order and esewa
        $randomOrderID = $lastorderId + 1;

        $paymentMethod = PaymentMethod::where('slug', 'cash-on-delivery')->firstOrFail();

        $paymentMethodID = $paymentMethod->id;

        if (Auth::guard('retailer')->check()) {
            $userType = 'retailer';
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
        } elseif (Auth::guard('admin')->check()) {
            $userType = 'admin';
            $user = Admin::findOrFail(Auth::guard('admin')->id());
        } elseif (Auth::user()) {
            if (Auth::user()->is_wholesaler == 1) {
                $userType = 'wholesaler';
            } else {
                $userType = 'customer';
            }
            $user = User::findOrFail(Auth::user()->id);
        }


     // $lastorderId = ::orderBy('id', 'desc')->first();
      $siteSettings = SiteSetting::first();
      if( \Cart::getTotal() < $siteSettings->aplicable ){
        $deliverycharge =  $siteSettings->charge;
      } else {
       $deliverycharge = 0;
      }

        $userId = auth()->user()->id; // or any string represents user identifier
        $cart = \Cart::session($userId)->getContent();
        $order = new Order();
        $order->user_id = $user->id;
        $order->user_type = $userType;
        $order->random_id = random_int(1000,9999);;
        $order->payment_id = $paymentMethodID;
        $order->total_quantity = $totalQuantity;
        $order->total_amount = $totalAmount + $deliverycharge;
        $order->delivery_charge = $deliverycharge;
        $order->status = Order::ORDER_COMPLETE;
        $order->payment_status = Order::PAYMENT_PENDING;
        $order->order_date =  Carbon::now()->timezone('Asia/Kathmandu');
        $order->save();

        foreach ($cart as $data) {
            $product = Product::where('id', $data['id'])->with('retailer')->firstOrFail()->toArray();

            $retailerID = $product['retailer']['id'];
            // dd($retailerID);

            $productID = $product['id'];
            $quantity = $data['quantity'];
            $OrderPro = new OrderProduct();
            $OrderPro->order_id = $order->id;
            $OrderPro->product_id = $productID;
            $OrderPro->product_image = $data['attributes']['image'];
            $OrderPro->retailer_id = $retailerID;
            $OrderPro->product_name = $data['name'];
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $quantity;
            $OrderPro->save();
        }

        $userId = auth()->user()->id;
        \Cart::session($userId)->clear();

        return redirect()->route('cart.index')->with([
            'success_msg' => 'Thank you for your shopping, Your product will be at your door step ASAP.',
        ]);
  }

    public function cashOnDelivery1(Request $request)
    {


        $this->validate($request,[
           'address'=>'required',
           'contact_no'=>'required|numeric|digits:10'
       ]);


         $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId); // or any string represents user identifier

         $totalAmount = \Cart::getTotal();

        $totalQuantity = \Cart::getTotalQuantity();

        $paymentMethod = PaymentMethod::where('slug', 'cash-on-delivery')->firstOrFail();

        $paymentMethodID = $paymentMethod->id;

        if (Auth::guard('retailer')->check()) {
            $userType = 'retailer';
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
        } elseif (Auth::guard('admin')->check()) {
            $userType = 'admin';
            $user = Admin::findOrFail(Auth::guard('admin')->id());
        } elseif (Auth::user()) {
            if (Auth::user()->is_wholesaler == 1) {
                $userType = 'wholesaler';
            } else {
                $userType = 'customer';
            }
            $user = User::findOrFail(Auth::user()->id);
        }


     // $lastorderId = ::orderBy('id', 'desc')->first();
      $siteSettings = SiteSetting::first();
      if( \Cart::getTotal() < $siteSettings->aplicable ){
        $deliverycharge =  $siteSettings->charge;
      } else {
       $deliverycharge = 0;
      }

        $userId = auth()->user()->id; // or any string represents user identifier
        $cart = \Cart::session($userId)->getContent();
        $order = new Order();
        $order->user_id = $user->id;
        $order->user_type = $userType;
        $order->random_id = random_int(1000,9999);;
        $order->payment_id = $paymentMethodID;
        $order->total_quantity = $totalQuantity;
        $order->total_amount = $totalAmount + $deliverycharge;
        $order->delivery_charge = $deliverycharge;
        $order->order_date =  Carbon::now()->timezone('Asia/Kathmandu');
        $order->status = Order::ORDER_COMPLETE;
        $order->payment_status = Order::PAYMENT_PENDING;
        $order->save();

        foreach ($cart as $data) {
            $product = Product::where('id', $data['id'])->with('retailer')->firstOrFail()->toArray();

            $retailerID = $product['retailer']['id'];
            // dd($retailerID);

            $productID = $product['id'];
            $quantity = $data['quantity'];
            $OrderPro = new OrderProduct();
            $OrderPro->order_id = $order->id;
            $OrderPro->product_id = $productID;
            $OrderPro->product_image = $data['attributes']['image'];
            $OrderPro->retailer_id = $retailerID;
            $OrderPro->product_name = $data['name'];
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $quantity;
            $OrderPro->save();
        }

        $userId = auth()->user()->id;
        \Cart::session($userId)->clear();

        return redirect()->route('cart.index')->with([
            'success_msg' => 'Thank you for your shopping, Your product will be at your door step ASAP.',
        ]);
    }

    public function paymentMethods(Request $request)
    {

        $this->validate($request,[
            'address'=>'required',
            'contact_no'=>'required|numeric|digits:10'
        ]);

         $userId = auth()->user()->id; // or any string represents user identifier

        $user = User::where('id', $userId)->firstOrFail();
        $user->update(
            [
                'address' => $request->address,
                'contact_no' => $request->contact_no,
            ]
        );

         $cartCollection = \Cart::session($userId)->getContent();

        $paymentMethods = PaymentMethod::where('status', 1)->select('title', 'slug', 'url', 'status', 'image')->get();
        $productID = uniqid();
        if (\Cart::getTotalQuantity()) {
            return view('Frontend.Payment-Methods.list')->with(
                [
                    'cartCollection' => $cartCollection,
                    'paymentMethods' => $paymentMethods,
                    'productID' => $productID,
                ]
            );
        } else {
            return redirect()->route('cart.index');
        }
    }
}
