<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Admin;
use App\Models\User;
use App\Models\Retailer;
use App\Models\Product;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;


class EsewaController extends Controller
{
     public function esewaPay(Request $request)
     {
       $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId); // or any str
        $totalAmount = \Cart::getTotal();

        $totalQuantity = \Cart::getTotalQuantity();

        $lastorderId = Order::orderBy('id', 'desc')->first()->random_id ?? 2300;
        // Generates random order id for order and esewa
        $randomOrderID = $lastorderId + 1;

        $paymentMethod = PaymentMethod::where('slug', 'esewa')->firstOrFail();

        $paymentMethodID = $paymentMethod->id;

     // $lastorderId = ::orderBy('id', 'desc')->first();
      $siteSettings = \App\SiteSetting::first();
      if( \Cart::getTotal() < $siteSettings->aplicable ){
        $deliverycharge =  $siteSettings->charge;
      } else {
       $deliverycharge = 0;
      }


        $userId = auth()->user()->id; // or any string represents user identifier
        $cart = \Cart::session($userId)->getContent();

         if (Auth::guard('retailer')->check()) {
            $user = Retailer::findOrFail(Auth::guard('retailer')->id());
            $userID = $user->id;
        } elseif (Auth::guard('admin')->check()) {
            $user = Admin::findOrFail(Auth::guard('admin')->id());
            $userID = $user->id;
        } elseif (Auth::user()) {
            $user = User::findOrFail(Auth::user()->id);
            $userID = $user->id;
        }

         Order::insert([
             'user_id' => $userID,
              'user_type' => 'customer',
             'random_id' => $randomOrderID,
             'total_amount' => $totalAmount + $deliverycharge,
             'total_quantity' => $totalQuantity,
             'payment_id' => $paymentMethodID,
             'delivery_charge' => $deliverycharge,
              'order_date' => Carbon::now()->timezone('Asia/Kathmandu'),
             'updated_at' => Carbon::now()->timezone('Asia/Kathmandu'),
             'status' => Order::ORDER_COMPLETE,
             'payment_status' => Order::PAYMENT_PENDING,
         ]);

        $orderID = DB::getPdo()->lastInsertId();


        foreach ($cart as $data) {
            $product = Product::where('id', $data['id'])->with('retailer')->firstOrFail()->toArray();

            $retailerID = $product['retailer']['id'];
            // dd($retailerID);

            $productID = $product['id'];
            $quantity = $data['quantity'];
            $OrderPro = new OrderProduct();
            $OrderPro->order_id = $orderID;
            $OrderPro->product_id = $productID;
            $OrderPro->product_image = $data['attributes']['image'];
            $OrderPro->retailer_id = $retailerID;
            $OrderPro->product_name = $data['name'];
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $quantity;
            $OrderPro->save();
        }

         // set success and failure callback urls
         $successUrl = url('/success');

         $failureUrl = url('/failure');

         $userId = auth()->user()->id; // or any string represents user identifier

         $user = User::where('id', $userId)->firstOrFail();
         $user->update(
            [
                'address' => $request->address,
                'contact_no' => $request->contact_no,
            ]
        );

        // config for production
        $config = new Config($successUrl, $failureUrl, 'NP-ES-RKMC', 'production');


         // initialize eSewa client
         $esewa = new Client($config);

          $esewa->process($randomOrderID, $totalAmount, 0, 0,$deliverycharge );
     }


     public function esewaPaySuccess(Request $request)
     {
         //do when pay success.
         $pid = $_GET['oid'];
         $refId = $_GET['refId'];
         $amount = $_GET['amt'];

         $order = Order::where('random_id', $pid)->first();
         //dd($order);
         $update_status = Order::find($order->id)->update([
           'payment_status' => 1,
             'updated_at' => Carbon::now(),
         ]);

        // dd($request);

            $userId = auth()->user()->id;
        \Cart::session($userId)->clear();


         $cartCollection = \Cart::session($userId)->getContent();

         if ($update_status) {
             //send mail,....
             //
            return redirect()->route('cart.index')->with([
                'success_msg' => 'Thank you for your shopping, Your recent payment was successful.',
            ]);
         }
     }

     public function esewaPayFailed(Request $request)
     {
         //do when payment fails.
         $pid = $_GET['pid'];
         $order = Order::where('random_id', $pid)->first();
         //dd($order);
         $update_status = Order::find($order->id)->update([
             'payment_status' => 0,
             'status' => 6,
             'updated_at' => Carbon::now(),
         ]);

          $userId = auth()->user()->id; // or any string represents user identifier


         $cartCollection = \Cart::session($userId)->getContent();

         if ($update_status) {
             //send mail,....
             //
             return redirect()->route('cart.index')->with([
            'alert_msg' => 'The payment has been declined, Please Try again.',
           ]);
         }
     }
}