<?php

namespace App\Http\Requests\user_client;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateUserClientOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'shopping_cart_id' => 'numeric|exists:shopping_cart,shopping_cart_id',
            'user_id' => 'numeric|exists:user,user_id',
        ];
    }
}
