<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Order extends Model
{
    const PAYMENT_COMPLETED = 1;
    const PAYMENT_PENDING = 0;

    const ORDER_COMPLETE = 1;
    const ORDER_CANCELLED = 2;
    const ORDER_DELIVERED = 3;
    const ORDER_OUT_FOR_DELIVERY = 4;
    const ORDER_CONFIRMED = 5;
    const ORDER_FAILED = 6;


    protected $fillable = ['random_id','transaction_id','user_type','payment_id','total_quantity', 'total_amount','delivery_charge',
     'payment_status', 'status','user_id','order_date','order_type','address_id','delivery_date','remark','assign_user_id'];

     protected $casts = [
        'status' => 'integer',
        'user_id' => 'integer',
        'payment_id' => 'integer',
        'total_quantity' => 'integer',
        'total_amount' => 'integer',
        'delivery_charge' => 'integer',
        'assign_user_id' => 'integer',
        'payment_status' => 'integer',
    ];
    public function scopeOrderType($query, $type)
    {
        return $query->where('order_type', $type);
    }

    public function getOrderDetailsAttribute()
    {
        return [
            'ordered_date' => Carbon::parse($this->created_at)->format('m/d/Y') ?? '',
            'delivery_date' => Carbon::parse($this->delivery_date)->format('m/d/Y') ?? '',
            'total_quantity' => $this->total_quantity ?? '',
            'total_amount' => $this->payment_status == 1 ? 0 : $this->total_amount,
            'random_id' => $this->random_id ?? '',
            'status' => $this->status ?? '',
            'payment' => $this->payment_method->title ?? '',

        ];
    }

    public function getOrderingCustomerAttribute()
    {
        $image = null;
        if($this->user && $this->user->image != null){
            $image = 'Asset/Uploads/Users/' . $this->user->image;
        }
        if($this->retailer && $this->retailer->image != null){
           $image = 'Asset/Uploads/Users/' . $this->retailer->image;
        }
        if ($this->user_type == 'customer') {
            return [
                'random_id' => $this->user->random_id ?? '',
                'name' => $this->user->name ?? '',
                'image' => $image,
                'address' => $this->user->address ?? '',
                'contact_no' => $this->user->contact_no ?? '',
                'email' => $this->user->email ?? '',
            ];
        } elseif ($this->user_type == 'wholesaler') {
            return [
                'random_id' => $this->user->random_id ?? '',
                'name' => $this->user->name ?? '',
                'image' => $image,
                'address' => $this->user->address ?? '',
                'contact_no' => $this->user->contact_no ?? '',
                'email' => $this->user->email ?? '',
            ];
        } elseif ($this->user_type == 'admin') {
            return [
                'random_id' => $this->user->random_id ?? '',
                'name' => $this->admin->name ?? '',
                'address' => $this->admin->address ?? '',
                'contact_no' => $this->admin->contact_no ?? '',
                'email' => $this->admin->email ?? '',
            ];
        } elseif ($this->user_type == 'retailer') {
            return [
                'random_id' => $this->user->random_id ?? '',
                'name' => $this->retailer->name ?? '',
                'image' => $image,
                'address' => $this->retailer->address ?? '',
                'contact_no' => $this->retailer->contact_no ?? '',
                'email' => $this->retailer->email ?? '',
            ];
        }
    }

    public function getPaymentAttribute()
    {
        if ($this->payment_status == '1') {
            return 'Paid using' . ' ' . $this->payment_method->title ?? '';
        } elseif ($this->payment_status == '0') {
            return $this->payment_method->title ?? '';
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adminUser()
    {
        return $this->belongsTo(Admin::class,'assign_user_id');
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function admin()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getMyOrderStatusAttribute()
    {
        if ($this->status == 1) {
            return [
                'status' => 'badge badge-success',
                'message' => 'Ordered',
            ];
        } elseif ($this->status == 2) {
            return [
                'status' => 'badge badge-primary',
                'message' => 'Cancelled',
            ];
        } elseif ($this->status == 3) {
            return [
                'status' => 'badge badge-primary',
                'message' => 'Delivered',
            ];
        } elseif ($this->status == 4) {
            return [
                'status' => 'badge badge-secondary',
                'message' => 'Out For Delivery',
            ];
        } elseif ($this->status == 5) {
            return [
                'status' => 'badge badge-secondary',
                'message' => 'Confirmed  Delivery',
            ];
        }elseif ($this->status == 6) {
            return [
                'status' => 'badge badge-secondary',
                'message' => 'Payment Failed',
            ];
        }
    }
}
