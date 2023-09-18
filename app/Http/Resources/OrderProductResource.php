<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'retailer_id' => $this->retailer_id,
            'product_name' => $this->product_name,
            'product_image' => $this->product_image,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
