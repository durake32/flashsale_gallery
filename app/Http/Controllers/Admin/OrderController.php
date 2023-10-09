<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\UpdateOrder;
use App\Models\Admin;
use App\Models\Order;
use App\Models\DirectOrder;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
       $orders = Order::orderType('customer_added')->with('order_products.product')
                ->where('order_type','customer_added')
                ->orderBy('order_date','desc')
                ->latest()->get();
        $directorders = DirectOrder::where('status', 1)
            ->count();
        $cancelledorders = Order::where('status', 2)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();
          $confirmedorders = Order::where('status', 5)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
          $pendingorders = Order::where('status', 1)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

           $deliveredorders = Order::where('status', 3)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

        $paymentFail = Order::where('status', 6)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();


      $outForDelivery = Order::where('status', 4)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
        } else {
            redirect()->back();
        }
        return view('Dashboard.Admin.Order.index', compact('orders','pendingorders','cancelledorders','deliveredorders','outForDelivery','directorders','confirmedorders','paymentFail'));
    }

    public function pendingOrders()
    {
        $orders = Order::where('status', 1)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->latest()->get();
        $directorders = DirectOrder::where('status', 1)
            ->count();
        $cancelledorders = Order::where('status', 2)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
         $confirmedorders = Order::where('status', 5)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
         $confirmedorders = Order::where('status', 2)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
          $pendingorders = Order::where('status', 1)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
           $deliveredorders = Order::where('status', 3)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

               $paymentFail = Order::where('status', 6)
               ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();

      $outForDelivery = Order::where('status', 4)
        ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();  

        return view('Dashboard.Admin.Order.index', compact('orders','pendingorders','cancelledorders','deliveredorders','outForDelivery','directorders','confirmedorders','paymentFail'));
    }


      public function paymentFail()
    {

        $orders = Order::where('status', 6)
        ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->latest()->get();
            $directorders = DirectOrder::where('status', 1)
            ->count();
        $cancelledorders = Order::where('status', 2)
        ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
         $confirmedorders = Order::where('status', 5)
         ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
         $confirmedorders = Order::where('status', 2)
         ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
          $pendingorders = Order::where('status', 1)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
           $deliveredorders = Order::where('status', 3)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();


        $outForDelivery = Order::where('status', 4)
        ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();

       $paymentFail = Order::where('status', 6)
       ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();

        return view('Dashboard.Admin.Order.index', compact('orders','pendingorders','cancelledorders','deliveredorders','outForDelivery','directorders','confirmedorders','paymentFail'));
    }



    public function cancelledOrders()
    {

        $orders = Order::where('status', 2)
        ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->latest()->get();
            $directorders = DirectOrder::where('status', 1)
            ->count();
        $cancelledorders = Order::where('status', 2)
        ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

            $confirmedorders = Order::where('status', 5)
                ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
          $pendingorders = Order::where('status', 1)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

           $deliveredorders = Order::where('status', 3)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

               $paymentFail = Order::where('status', 6)
               ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();


      $outForDelivery = Order::where('status', 4)
      ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

        return view('Dashboard.Admin.Order.index', compact('orders','pendingorders','cancelledorders','deliveredorders','outForDelivery','directorders','confirmedorders','paymentFail'));
    }


     public function confirmedOrders()
    {
        $orders = Order::where('status', 5)
        ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->latest()->get();
            $directorders = DirectOrder::where('status', 1)
            ->count();
        $cancelledorders = Order::where('status', 2)
        ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
          $confirmedorders = Order::where('status', 5)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
          $pendingorders = Order::where('status', 1)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

           $deliveredorders = Order::where('status', 3)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

             $paymentFail = Order::where('status', 6)
              ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();


      $outForDelivery = Order::where('status', 4)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();

        return view('Dashboard.Admin.Order.index', compact('orders','pendingorders','cancelledorders','deliveredorders','outForDelivery','directorders','confirmedorders','paymentFail'));
    }


    public function deliveredOrders()
    {

        $orders = Order::where('status', 3)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->latest()->get();
            $directorders = DirectOrder::where('status', 1)
            ->count();
        $cancelledorders = Order::where('status', 2)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

        $confirmedorders = Order::where('status', 5)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

            $pendingorders = Order::where('status', 1)
            ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();

            $deliveredorders = Order::where('status', 3)
            ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();

             $paymentFail = Order::where('status', 6)
             ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();


      $outForDelivery = Order::where('status', 4)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

        return view('Dashboard.Admin.Order.index', compact('orders','pendingorders','cancelledorders','deliveredorders','outForDelivery','directorders','confirmedorders','paymentFail'));
    }

    public function outForDelivery()
    {

        $orders = Order::where('status', 4)
          ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->latest()->get();

            $directorders = DirectOrder::where('status', 1)
            ->count();
        $cancelledorders = Order::where('status', 2)
            ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
          $pendingorders = Order::where('status', 1)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
             $confirmedorders = Order::where('status', 5)
             ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();
           $deliveredorders = Order::where('status', 3)
           ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

            $paymentFail = Order::where('status', 6)
             ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
           ->orderBy('updated_at','desc')
            ->count();


      $outForDelivery = Order::where('status', 4)
      ->where('order_type','customer_added')
            ->with('order_products.user')
            ->with('order_products.product')
            ->orderBy('updated_at','desc')
            ->count();

        return view('Dashboard.Admin.Order.index', compact('orders','pendingorders','cancelledorders','deliveredorders','outForDelivery','directorders','confirmedorders','paymentFail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = Admin::role('delivery person')->latest()->get();
        if (Auth::guard('admin')->check()) {
            $order = Order::where('id', $id)
                ->with('order_products.product')
                ->with('order_products.user')
                ->firstOrFail();
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $order = Order::where('id', $id)
                ->with('order_products.user')
                ->with('order_products.product')
                ->firstOrFail();
        }
        return view('Dashboard.Admin.Order.edit', compact('order','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrder $request, $id)
    {
        $segment = $request->segment(1);
        if (Auth::guard('admin')->check()) {
            $order = Order::where('id', $id)
                ->with('order_products.product')
                ->with('order_products.user')
                ->firstOrFail();
        } elseif (Auth::guard('retailer')->check()) {
            $retailerID = Auth::guard('retailer')->user()->id;
            $order = Order::where('id', $id)
                ->with('order_products.user')
                ->with('order_products.product')
                ->firstOrFail();
        }

        $order->status = $request->input('status');
        $order->delivery_date = $request->input('delivery_date');
        $order->assign_user_id = $request->input('assign_user');

        if(!empty($request->input('status') == 3)){
            $order->payment_status = 1;
        } else {
            $order->payment_status = 0;
        }
        $order->save();

       Session::flash('success', 'Order Updated Sucessfully !!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
       Session::flash('error', 'Order Deleted Sucessfully !!');
        return redirect()->back();
    }

    public function InvoiceDownload($orderId){
        $orders = Order::findOrFail($orderId);
        $order = Order::
            select('orders.*','users.name as name','users.email as email','users.contact_no as phone','users.address as address')
            ->where('user_id', $orders->user_id)
            ->where('orders.id', $orders->id)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->first();
        $orderItem = OrderProduct::where('order_id',$orderId)->orderBy('id','DESC')->get();
        $pdf = PDF::loadView('Dashboard.Admin.Order.order_invoice',compact('order','orderItem'))
        ->setPaper('a4');
        return $pdf->download('invoice.pdf');
    }
}