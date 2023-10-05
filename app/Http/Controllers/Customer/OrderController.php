<?php

namespace App\Http\Controllers\Customer;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\OrderExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Excel;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $user = User::findOrFail(Auth::user()->id);
        $tableOrders=Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->where('order_type','customer_added')
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
             ->orderBy('updated_at', 'desc')->get();
        $query = Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->where('order_type','customer_added')
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->orderBy('updated_at', 'desc')->get();

                if($request->query('search')){
                    $search=$request->search;
                    $query->whereHas('order_products',function($query) use($search){
                            $query->where('product_name','LIKE','%'.$search.'%');
                    });
                }
                $orders = $query;
        // dd($orders);
        return view('Dashboard.Customer.Orders.index', compact('orders','tableOrders'));
    }

    public function offlineOrderIndex(Request $request)
    {
        if (Auth::user()->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $user = User::findOrFail(Auth::user()->id);
        $tableOrders=Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->where('order_type','admin_added')
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
             ->orderBy('updated_at', 'desc')->get();
        $query = Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->orderBy('updated_at', 'desc')->get();

                if($request->query('search')){
                    $search=$request->search;
                    $query->whereHas('order_products',function($query) use($search){
                            $query->where('product_name','LIKE','%'.$search.'%');
                    });
                }
                $orders = $query;
        return view('Dashboard.Customer.Orders.offline-order', compact('orders','tableOrders'));
    }
    public function exportOrder()
    {
        return Excel::download(new OrderExport,'order.xlsx');
    }

    public function search(Request $request)
    {

    }

    public function trackOrder(Request $request)
    {
        if (Auth::user()->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $user = User::findOrFail(Auth::user()->id);
        $tableOrders=Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->orderBy('updated_at', 'desc')->get();
        $query = Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
            ->orderBy('updated_at', 'desc')->get();

                if($request->query('search')){
                    $search=$request->search;
                    $query->whereHas('order_products',function($query) use($search){
                            $query->where('product_name','LIKE','%'.$search.'%');
                    });
                }
               $orders = $query;
        return view('Dashboard.Customer.Orders.track-order', compact('orders','tableOrders'));
    }

    public function paymentHistory(Request $request)
    {
        if (Auth::user()->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $user = User::findOrFail(Auth::user()->id);
        $tableOrders=Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
             ->orderBy('updated_at', 'desc')->get();
        $query = Order::where('user_type', $userType)
            ->where('user_id', $user->id)
            ->with('order_products')
            ->with('order_products.product')
            ->with('payment_method')
           ->orderBy('updated_at', 'desc')->get();

                if($request->query('search')){
                    $search=$request->search;
                    $query->whereHas('order_products',function($query) use($search){
                            $query->where('product_name','LIKE','%'.$search.'%');
                    });
                }
                $orders=$query;
        return view('Dashboard.Customer.Payment.index', compact('orders','tableOrders'));
    }

    public function orderCheck($orderId)
    {
        $orders= Order::with('order_products')->where('random_id',$orderId)->orderBy('updated_at', 'desc')->get();
        return view('Dashboard.Customer.Orders.order-check', compact('orders'));

    }

    public function orderCancel($orderId){
        $orders = Order::findOrFail($orderId);
        return view('Dashboard.Customer.Orders.order-cancel', compact('orders'));

    }

    public function ordersCancel(Request $request, $orderId){
     $order = Order::findOrFail($orderId);
        $data = $request->all();
          $this->validate($request,[
            'status'=>'required',
            'remark'=>'required|max:100'
        ]);

        $order->status = $request->status;
        $order->remark = $request->remark;
        $order->updated_at = Carbon::now();
        $order->save();
        return redirect()->route('customer.order', compact('order'))->withMessage('Order Cancelled Successfully');
    }

    public function InvoiceDownload($orderId){
        $orders = Order::findOrFail($orderId);
        $order = DB::table('orders')
            ->select('orders.*','users.name as name','users.email as email','users.contact_no as phone','users.address as address')
            ->where('user_id', $orders->user_id)
            ->where('orders.id', $orders->id)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->first();
        $orderItem = OrderProduct::where('order_id',$orderId)->orderBy('id','DESC')->get();
        $pdf = PDF::loadView('Dashboard.Admin.Order.order_invoice',compact('order','orderItem'));
        return $pdf->download('invoice.pdf');
    } // end 


}