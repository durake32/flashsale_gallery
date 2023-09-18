<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CalendarEvent;
use Session;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = CalendarEvent::get();
        return view('Dashboard.Admin.calendar.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('Dashboard.Admin.calendar.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'program_name' => 'required|string',
            'event_date' => 'required|date',
            'email' => 'required|string|email',
        ]);
        $event = new CalendarEvent();
        $event->user_id = $request->user_id;
        $event->program_name = $request->program_name;
        $event->event_date = $request->event_date;
        $event->email = $request->email;
        $event->save();
        Session::flash('success', 'Program Created Sucessfully !!');
        return redirect()->route('admin.calendars.index');
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
        $users = User::get();
        $event = CalendarEvent::findOrFail($id);
        return view('Dashboard.Admin.calendar.edit',compact('users','event'));
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
            'user_id' => 'required|exists:users,id',
            'program_name' => 'required|string',
            'event_date' => 'required|date',
            'email' => 'required|string|email',
        ]);
        $event = CalendarEvent::findOrFail($id);
        $event->user_id = $request->user_id;
        $event->program_name = $request->program_name;
        $event->event_date = $request->event_date;
        $event->email = $request->email;
        $event->save();
        Session::flash('success', 'Program updated Sucessfully !!');
        return redirect()->route('admin.calendars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = CalendarEvent::findOrFail($id);
        $event->delete();
        Session::flash('success', 'Program deleted Sucessfully !!');
        return redirect()->route('admin.calendars.index');
    }
}