<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CustomerType;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function customer(Request $request){
        $query = User::query()->withCount('orders');
        $customers = $query
                    ->when($request->location, function($q) use ($request){
                        $q->where('location_id',$request->location);
                    })
                    ->when($request->type, function($q) use ($request){
                        $q->where('customer_type_id',$request->type);
                    })
                    ->when($request->from_date && $request->to_date, function($q) use ($request){
                        $start = Carbon::parse($request->get('from_date'))
                            ->format('Y-m-d') ?? today();
                        $end = Carbon::parse($request->get('to_date'))
                            ->format('Y-m-d') ?? today();
                        $q->whereBetween('created_at',[$start,$end]);
                    })
                    ->latest()->get();
        $locations = Location::get();
        $types = CustomerType::get();
        return view('Dashboard.reports.customer',compact('customers','locations','types'));
    }  

    public function order(Request $request){
        $query = Order::query();
        $orders = $query
                    ->when($request->user, function($q) use ($request){
                        $q->where('user_id',$request->user);
                    })
                    ->when($request->order_type, function($q) use ($request){
                        $q->where('order_type',$request->order_type);
                    })
                    ->when($request->status, function($q) use ($request){
                        $q->where('status',$request->status);
                    })
                    ->when($request->payment_type, function($q) use ($request){
                        $q->where('payment_status',$request->payment_type);
                    })
                    ->when($request->assign_to, function($q) use ($request){
                        $q->where('assign_user_id',$request->assign_to);
                    })
                    ->when($request->from_date && $request->to_date, function($q) use ($request){
                        $start = Carbon::parse($request->get('from_date'))
                            ->format('Y-m-d') ?? today();
                        $end = Carbon::parse($request->get('to_date'))
                            ->format('Y-m-d') ?? today();
                        $search_by = $request->get('search_by') ?? 'order_date';
                        $q->whereBetween($search_by,[$start,$end]);
                    })
                    ->latest()->get();
        $users = User::has('orders')->get();
        $payments = PaymentMethod::where('status',1)->get();
        $assigned_users =  Admin::role('delivery person')->get();
        return view('Dashboard.reports.order',compact('orders','users','assigned_users','payments'));
    }  

    public function customer_product(Request $request){
        $query = OrderProduct::query()->whereHas('order',function($q){
                    $q->where('status',3);
                });
        $order_products = $query
                    ->when($request->user, function($q) use ($request){
                        $q->whereHas('order',function($query) use ($request){
                            $query->where('user_id',$request->user);
                        });
                    })
                    ->when($request->order, function($q) use ($request){
                        $q->whereHas('order', function ($query) use ($request) {
                            $query->where('random_id',$request->order);
                         });
                    })
                    ->when($request->product, function($q) use ($request){
                        $q->where('product_id', $request->product);
                    })
                    ->when($request->from_date && $request->to_date, function($q) use ($request){
                        $q->whereHas('order', function ($query) use ($request) {
                            $start = Carbon::parse($request->get('from_date'))
                                ->format('Y-m-d') ?? today();
                            $end = Carbon::parse($request->get('to_date'))
                                ->format('Y-m-d') ?? today();
                            $search_by = $request->get('search_by') ?? 'order_date';
                            $query->whereBetween($search_by,[$start,$end]);
                         });
                    })
                    ->latest()->get();
        $products = Product::where('status',1)->get();
        $users = User::has('orders')->get();
        return view('Dashboard.reports.customer_product',compact('users','order_products','products'));
    }  
}
