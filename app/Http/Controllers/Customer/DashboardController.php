<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Dashboard/Customer/Dashboard/index');
    }

    public function calendarEventData()
    {
        $events = CalendarEvent::where('user_id',auth()->user()->id)->get();
        return view('Dashboard/Customer/Dashboard/calendar',compact('events'));

    }
}