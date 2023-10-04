<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
  
    protected $guard = 'sitesetting';
  
    protected $casts = [
        'aplicable'=>'integer',
        'charge'=>'integer',
        'minimum_amount'=>'integer',
        'enable_flash_sale' => 'integer',
        'sale_from' => 'date',
        'sale_to' => 'date'
    ];

    public function getSiteDefaultImageAttribute()
    {
        return 'Asset/Uploads/Default/' . $this->attributes['default_image'];
    }
}
