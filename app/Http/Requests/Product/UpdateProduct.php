<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required', 'string', 'max:255', 'unique:products,' . $this->name,
            'image' => 'nullable|image|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
        ];
    }
}
