<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\DirectOrder;
use App\Http\Requests\Order\DirectOrders;
use  Illuminate\Support\Facades\Mail;

class ScrapSellController extends Controller
{
    public function index()
    {
        return view('Frontend.Direct-Order.scrap-sell');
    }

    public function store(DirectOrders $request)
    {


        $order = new DirectOrder();
         $order->name = $request->name;
         $order->contact_number = $request->contact_number;
         $order->address = $request->address;
         $order->body = $request->body;
         $order->type = $request->type;
         $order->save();
       return redirect()->back()->withMessage('Successfully send');

    }
}