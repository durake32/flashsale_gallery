<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CalendarEvent;
use App\Mail\CalendarEventMail;
use Illuminate\Support\Facades\Mail;

class SendCalendarEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:calendar_events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $events = CalendarEvent::where('is_sent',0)->whereBetween('event_date', [now(),now()->addWeek()])->get();
        foreach($events as $event){
            Mail::to($event->email)
            ->cc('ceodailomaa@gmail.com')
            ->send(new CalendarEventMail($event));
            $event->is_sent = 1;
            $event->save();
        }
        return 0;
    }
}