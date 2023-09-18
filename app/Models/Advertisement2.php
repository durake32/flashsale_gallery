<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement2 extends Model
{
    protected $guarded=[];
    protected $table="advertisements2";

    protected $casts = [
        'type_id' => 'integer'
    ];
}