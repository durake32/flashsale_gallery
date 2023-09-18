<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $casts = [
        'type_id' => 'integer'
    ];

    protected $table="advertisements";
    protected $fillable=["title","url",'link','type','type_id'];


}