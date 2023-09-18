<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    protected $casts = [
        'user_id' => 'integer',
        'event_date' => 'date'
    ];
    protected $fillable = [
        'program_name', 'event_date', 'user_id','email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}