<?php

namespace App\Http\Requests\rating;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateRatingOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'rate' => 'numeric',
            'opinion' => 'max:250',
            'date' => 'date',
            'user_client_id' => 'numeric|exists:user_client,user_client_id',
            'product_id' => 'numeric|exists:product,product_id',
        ];
    }
}
