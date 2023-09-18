<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class OfflineOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $orders = Order::with('order_products.product')
                     ->where('order_type','admin_added')
                     ->orderBy('updated_at','desc')
                     ->get();
        }else {
            redirect()->back();
        }
        return view('Dashboard.Admin.Order.offline.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = User::get();
        $users = Admin::role('delivery person')->get();
        $products = Product::active()->get();
        return view('Dashboard.Admin.Order.offline.create',compact('customers','products','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array = [];
        $product = $request->product;
        $sell_price = $request->sell_price;
        $product_quantity = $request->product_quantity;
        for($i = 0; $i < count($product); $i++)
        {
           $array[] = [
                "id" => $product[$i],
                "price"=>$sell_price[$i],
                "qty"=> $product_quantity[$i]
           ];
        }

        $user = User::find($request->user_id);
        if ($user->is_wholesaler == 1) {
            $userType = 'wholesaler';
        } else {
            $userType = 'customer';
        }
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->user_type = $userType;
        $order->random_id = random_int(1000,9999);
        $order->total_quantity = array_sum($request->product_quantity);
        $order->total_amount = $request->total + $request->delivery_charge;
        $order->delivery_charge = $request->delivery_charge ?? 0;
        $order->delivery_date = $request->delivery_date;
        $order->assign_user_id = $request->assign_user;
        $order->status = $request->order_status;
        $order->order_type = 'admin_added';
        $order->payment_status = 4;
        $order->order_date = $request->order_date;
        $order->updated_at = $request->order_date;
        $order->save();

        foreach ($array as $data) {
            $product = Product::where('id', $data['id'])->with('retailer')->firstOrFail()->toArray();

            $retailerID = $product['retailer']['id'];

            $OrderPro = new OrderProduct();
            $OrderPro->order_id = $order->id;
            $OrderPro->product_id = $data['id'];
            $OrderPro->retailer_id = $retailerID;
            $OrderPro->product_name = $product['name'];
            $OrderPro->product_image = 'Asset/Uploads/Products/'.$product['main_image'];
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $data['qty'];
            $OrderPro->save();
        }
        Session::flash('success', 'Order Created Sucessfully !!');
        return redirect()->route('admin.offlineorders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = User::get();
        $order = Order::where('id', $id)
                ->with('order_products.product')
                ->with('order_products.user')
                ->firstOrFail();
        $allOrderProducts = $order->order_products;
        $orderProducts = [];
        for($i = 0 ; $i < count($allOrderProducts); $i++)
        {
            $pro_price = Product::findOrFail($allOrderProducts[$i]->product_id);
            $orderProducts[] = [
                "orderproduct_id" => $allOrderProducts[$i]->id, //order_products id
                "product_id" => $allOrderProducts[$i]->product_id, //product id
                "product_name" => $allOrderProducts[$i]->product_name,
                "product_price" => $pro_price->regular_price,
                "price" => $allOrderProducts[$i]->price, //here,price is selling price
                "qty" => $allOrderProducts[$i]->quantity,
                "total" => $allOrderProducts[$i]->price * $allOrderProducts[$i]->quantity ,
            ];
        }
        $users = Admin::role('delivery person')->get();
         $products = Product::active()->get();

        return view('Dashboard.Admin.Order.offline.edit', compact('order','customers','orderProducts','users','products'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
        ]);
       
        $product = $request->product;
        $sell_price = $request->sell_price;
        $product_quantity = $request->product_quantity;
        $orderproduct_id = $request->orderproduct;
        $qty = 0;
        $new_array = [];
        $old_array = [];
        $order = Order::findOrFail($id);
        $productCollect = $order->order_products()->pluck('product_id')->toArray();

        for($i = 0; $i < count($product); $i++){
            if(in_array($product[$i],$productCollect) ){
                $old_array[] = [
                    "price"=>$sell_price[$i],
                    "product"=>$product[$i],
                    "qty"=> $product_quantity[$i],
                    "orderproduct_id"=> $orderproduct_id[$i],
                ];
                $qty = $qty + $product_quantity[$i];
            }else{
                $new_array[] = [
                    "id" => $product[$i],
                    "price"=>$sell_price[$i],
                    "qty"=> $product_quantity[$i]
                ];
                $qty = $qty + $product_quantity[$i];
            }
        }
        
        $order->total_quantity = $qty;
        $order->total_amount = $request->total + $request->delivery_charge;
        $order->delivery_charge = $request->delivery_charge ?? 0;
        $order->delivery_date = $request->delivery_date;
        $order->status = $request->order_status; 
        $order->order_date = $request->order_date;
        $order->assign_user_id = $request->assign_user;
        $order->update();

        //$old_array is in multi nested array and $data is in nested array so we use foreach and retirive index[0] data
        foreach ($old_array as $data) {
            $OrderPro = OrderProduct::findOrFail($data['orderproduct_id']);
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $data['qty'];
            $OrderPro->update();
        }

        foreach ($new_array as $data) {
            $product = Product::where('id', $data['id'])->with('retailer')->firstOrFail()->toArray();
            $retailerID = $product['retailer']['id'];
            $OrderPro = new OrderProduct();
            $OrderPro->order_id = $order->id;
            $OrderPro->product_id = $data['id'];
            $OrderPro->retailer_id = $retailerID;
            $OrderPro->product_name = $product['name'];
            $OrderPro->product_image = 'Asset/Uploads/Products/'.$product['main_image'];
            $OrderPro->price = $data['price'];
            $OrderPro->quantity = $data['qty'];
            $OrderPro->save();
        }
       
        Session::flash('success', 'Order updated Sucessfully !!');
        return redirect()->route('admin.offlineorders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $OrderPro =  Order::findOrFail($id);
        $OrderPro->delete();
        Session::flash('success', 'Order delete Sucessfully !!');
        return redirect()->route('admin.offlineorders.index');
    }

    public function removeOrderProductItem($id){
        $OrderPro =  OrderProduct::findOrFail($id);
        $order = Order::findOrFail($OrderPro->order_id);
        $order->update([
            'total_amount' => $order->total_amount - ($OrderPro->price * $OrderPro->quantity)
        ]);
        $OrderPro->delete();
        return response()->json(204);
    }
}