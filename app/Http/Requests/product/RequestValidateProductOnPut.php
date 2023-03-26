<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateProductOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'numeric|exists:category,category_id',
            'name' => 'max:100',
            'description' => 'max:250',
            'price' => 'numeric',
            'properties' => 'max:250',
            'stock' => 'numeric',
        ];
    }
}
