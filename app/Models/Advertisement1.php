<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement1 extends Model
{
    protected $table="advertisements1";
    protected $casts = [
        'type_id' => 'integer'
    ];
    protected $fillable=['title','url','link','type','type_id'];
    public $timestamps = false;
}