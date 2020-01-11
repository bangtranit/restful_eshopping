<?php

namespace App\Http\Requests\Seller;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerProduct extends FormRequest
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
            //
            'name' => 'min:2|max:255',
            'description' => 'min:2|max:1000',
            'seller_id' => 'integer',
            'status' => 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
            'image' => 'image'
        ];
    }
}
