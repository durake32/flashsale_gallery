<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $table = 'menu_categories';

    protected $fillable = [
        'menu_category_name',
        'order',
        'status'
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function getActiveStatusAttribute()
    {
        if ($this->status == 1) {
            return [
                'status' => 'badge badge-success',
                'message' => 'Active',
            ];
        } else {
            return [
                'status' => 'badge badge-danger',
                'message' => 'InActive',
            ];
        }
    }
}
