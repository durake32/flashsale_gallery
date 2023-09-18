<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id'=> $this->user_id,
            'random_id'=> $this->random_id,
            'transaction_id'=> $this->transaction_id,
            'total_quantity'=> $this->total_quantity,
            'total_amount'=> $this->total_amount,
            'delivery_charge'=> $this->delivery_charge,
            'status'=> $this->status,
            'order_date'=> $this->order_date,
            'order_type'=> $this->order_type,
            'payment_id'=> $this->payment_id,
            'payment_status'=> $this->payment_status,
            'address_id'=> $this->address_id,
            'delivery_date'=> $this->delivery_date,
            'remark'=> $this->remark,
            'order_products'=> OrderProductResource::collection($this->order_products),
            'customer_info' => new AdminUserResource($this->user),
            'assign_user'=> new AdminUserResource($this->adminUser)
        ];
    }
}