<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'title' => $this->title,
            'email' => $this->email,
            'telephone_no' => $this->telephone_no,
            'mobile_no' => $this->mobile_no,
            'fax' => $this->fax,
            'address' => $this->address,
            'post_code' => $this->post_code,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
            'whatsapp' => $this->whatsapp,
            'youtube' => $this->youtube,
            'meta_title' => $this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'about' => $this->about,
            'site_url' => $this->site_url,
            'aplicable' => $this->aplicable,
            'charge' => $this->charge,
            'minimum_amount' => $this->minimum_amount,
            'enable_flash_sale' => $this->enable_flash_sale,
            'sale_from' => $this->sale_from,
            'sale_to' => $this->sale_to,
            'flash_title' => $this->flash_title,
            'google_maps' => $this->google_maps,
            'logo'=> !is_null($this->logo) ? '/Asset/Uploads/Logo/'.$this->logo : null,
            'popup'=> !is_null($this->popup) ? '/Asset/Uploads/Logo/'.$this->popup : null,
            'default_image'=> !is_null($this->default_image) ? '/Asset/Uploads/Logo/'.$this->default_image : null,
            'login_banner'=> !is_null($this->login_banner) ? '/Asset/Uploads/Logo/'.$this->login_banner : null,
            'flash_image'=> !is_null($this->flash_image) ? '/Asset/Uploads/Logo/'.$this->flash_image : null,
        ];
    }
}
