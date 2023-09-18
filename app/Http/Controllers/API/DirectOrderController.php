<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectOrder;
use App\Models\Contact;

class DirectOrderController extends Controller
{
      public function directOrder(Request $request){
         $order = new DirectOrder();
         $order->name = $request->name;
         $order->contact_number = $request->contact_number;
         $order->address = $request->address;
         $order->body = $request->body;
         $order->type = $request->type;
         $order->save();
         return response()->json([
          'success' => 'Successfully send Order',
          'status' => 'success',]);
    }
  
        public function sellScrap(Request $request){
         $order = new DirectOrder();
         $order->name = $request->name;
         $order->contact_number = $request->contact_number;
         $order->address = $request->address;
         $order->body = $request->body;
        $order->type = $request->type;
         $order->save();
         return response()->json([
          'success' => 'Successfully send Order',
          'status' => 'success',]);
      }
  
  
       public function Query(Request $request){
        $contact = new Contact();
        $contact['subject'] = $request->subject;
        $contact['name'] = $request->name;
        $contact['email'] = $request->email;
        $contact['phone_number'] = $request->phone_number;
        $contact['message'] = $request->message;
        $contact['status'] = 0;
        $contact->save();
         return response()->json([
          'success' => 'Thank you for contacting!!',
          'status' => 'success',]);
    }
  
  
  
  

}
