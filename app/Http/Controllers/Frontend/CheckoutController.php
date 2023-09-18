<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(Request $request)
    {
        $this->validate($request, $rules, $customMessages);
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

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        return view('Frontend.Order.checkout', compact('user', 'userType', 'product', 'quantity'));
    }

    public function cartCheckout(Request $request)
    {

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

        $paymentMethods = PaymentMethod::where('status', 1)->where('title','Esewa')->orWhere('title','Cash On Delivery')->select('title', 'slug', 'url', 'status','image')->get();

        // dd($request->all());
        $userId = auth()->user()->id; // or any string represents user identifier
       $cartCollection = \Cart::session($userId)->getContent();


        return view('Frontend.Cart.checkout', compact('user', 'userType', 'cartCollection', 'paymentMethods'));
    }
}
