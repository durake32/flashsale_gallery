<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $casts = [
        'brand_id'=>'integer',
        'category_id'=>'integer',
        'sub_category_id'=>'integer',
        'is_featured'=>'integer',
        'is_foryou'=>'integer',
        'section1'=>'integer',
        'section2'=>'integer',
        'regular_price'=>'integer',
        'sale_price'=>'integer',
        'wholesaler_price'=>'integer',
        'shipping_price'=>'integer',
        'allowed_quantity'=>'integer',
        'total'=>'integer',
        'retailer_id'=>'integer',
        'status'=>'integer',
    ];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $this->attributes['slug'] = Str::slug($value);
    }

    public function getFeaturedStatusAttribute()
    {
        if ($this->is_featured == 1) {
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

    public function getProductDetailsAttribute()
    {
        return [
            'name' => Str::limit($this->name, 30),
            'brand' => $this->brand->name,
            'slug' => $this->slug ?? '',
            'regular_price' => $this->regular_price ?? '',
            'sale_price' => $this->sale_price ?? '',
            'wholesaler_price' => $this->wholesaler_price ?? '',
            'allowed_quantity' => $this->allowed_quantity_per_order ?? '',
            'retailer' => $this->retailer->name ?? '',
            'main_image' => 'Asset/Uploads/Products/' . $this->attributes['main_image'],
            'created_date' => Carbon::parse($this->created_at)->format('m/d/Y'),
            'updated_date' => Carbon::parse($this->updated_at)->format('m/d/Y'),
            'description' => $this->description ?? '',

        ];
    }


    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function scopeOnlineProduct($query)
    {
        return $query->where('product_type','online');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

      public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'product_id','id');
    }
}