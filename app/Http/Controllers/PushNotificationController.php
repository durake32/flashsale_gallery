<?php

namespace App\Http\Controllers;

use App\Models\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
 
    public function index()
    {
        $notifications = PushNotification::orderBy('created_at', 'desc')->get();
        return view('Dashboard.Admin.notification.index', compact('notifications'));
    }

    public function create()
    {
        return view('Dashboard.Admin.notification.create');
    }

    public function bulksend(Request $req){
        $comment = new PushNotification();
        $comment->title = $req->input('title');
        $comment->body = $req->input('body');
        $comment->img = $req->input('img');
        $comment->save();
      
        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array(  
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            'id' => $req->id,
            'status'=>"done"
        );
        $notification = array(
            'title' =>$req->title,
             'body' => $req->body, 
             'image'=> $req->img, 
             'sound' => 'default', 
             'badge' => '1', 
             'android_channel_id' => 'dailomaa'
            );
        $arrayToSend = array(
            'to' => "/topics/DNotifications",
             'notification' => $notification,
              'data' => $dataArr,
               'priority'=>'high'
            );
        $fields = json_encode ($arrayToSend);
        $headers = array (
            'Authorization: key=' . "AAAA3HRoSi4:APA91bE0N0HikMfZ6uAW1RexwFd0SENV0H61EGfCESrDPBjQN10YIOcLwWYlwoZ1XT2jR0HTqSn8V7TbD3ohrN8PNwnfrMD-h266ZUWEbvKBg7L9vTgVLHDDJoAhc_5FeZr78yZ6u_gC",
            'Content-Type: application/json'
        );
    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
      
        return redirect()->route('admin.notification.index')->with('success', 'Notification Send successfully');
    }
    
}
