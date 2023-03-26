<?php

namespace App\Http\Requests\product_image;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateProductImageOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'numeric|exists:product,product_id',
            'image_path' => 'max:400',
        ];
    }
}
