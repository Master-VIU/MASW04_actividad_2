<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateProduct extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required|numeric|exists:category,category_id',
            'name' => 'required|max:100',
            'description' => 'required|max:250',
            'price' => 'required|numeric',
            'properties' => 'required|max:250',
            'stock' => 'required|numeric',
        ];
    }
}
