<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
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
            'id'=> $this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'contact_no'=> $this->contact_no,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'gender' => $this->gender,
            'image'=> !is_null($this->image) ? '/Asset/Uploads/Users/'.$this->image : null,
        ];
    }
}