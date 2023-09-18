<?php

namespace App\Http\Controllers\Frontend;

use App\Models\DirectOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\DirectOrders;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Mail;
use App\Models\DirectCategory;
class DirectOrderController extends Controller
{
    public function index()
    {
      $directCategories=DirectCategory::all();
        return view('Frontend.Direct-Order.index',compact('directCategories'));
    }
    public function scrapSellIndex()
    {
        return view('Frontend.Direct-Order.scrap-sell');
    }
    public function store(DirectOrders $request)
    {
      

        // dd($request->all());
         $order = new DirectOrder();
         $order->name = $request->name;
         $order->contact_number = $request->contact_number;
         $order->address = $request->address;
         $order->body = $request->body;
         $order->type = $request->type;
         $order->save();

      //  $data = ["name" => $request->name,"type"=>$request->type, "contact" => $request->contact_number, "address" => $request->address
     //   , "body" => $request->body];
     //       Mail::send('mail', $data, function ($message) use($data) {
                // $message->to('trekkinghubnepal@trekkinghubnepal.com');
       //         $message->subject("Message");
       //           $message->from($data['name']);
       //     });

            return redirect()->back()->withMessage('Successfully send Order');

    }
}