<?php

namespace App\Http\Requests\product_image;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateProductImage extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|numeric|exists:product,product_id',
            'image_path' => 'required|max:400',
        ];
    }
}
