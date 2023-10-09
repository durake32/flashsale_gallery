<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'slug'=> $this->slug,
            'product_type'=> $this->product_type,
            'brand_id'=> $this->brand_id,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'is_feature' => $this->is_feature,
            'is_foryou' => $this->is_foryou,
            'section1' => $this->section1, //is nepali product
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'is_discount' => $this->is_discount,
            'discount_amount' => $this->discount_amount,
            'discount_percentage' => $this->discount_percentage,
            'allowed_quantity' => $this->allowed_quantity,
            'total' => $this->total,
            'retailer_id' => $this->retailer_id,
            'description' => $this->description,
            'additional_information' => $this->additional_information,
            'meta_description' => $this->meta_description,
            'status' => $this->status,
            'main_image'=> !is_null($this->main_image) ? '/Asset/Uploads/Products/'.$this->main_image : null,
            'gallery'=> ProductImageList::collection($this->images),
        ];
    }
}
