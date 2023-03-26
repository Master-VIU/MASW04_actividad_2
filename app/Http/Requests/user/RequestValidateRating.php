<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateRating extends FormRequest
{
    public function rules()
    {
        return [
            'rate' => 'required|numeric',
            'opinion' => 'required|max:250',
            'date' => 'required|date',
            'user_client_id' => 'required|numeric|exists:user_client,user_client_id',
            'product_id' => 'required|numeric|exists:product,product_id',
        ];
    }
}
