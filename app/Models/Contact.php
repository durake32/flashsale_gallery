<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $casts = [
        'status' => 'integer',
    ];
    protected $fillable = [
        'subject',
        'name',
        'email',
        'phone_number',
        'message',
        'reply',
        'status',
    ];
}
