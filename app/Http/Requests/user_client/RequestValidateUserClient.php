<?php

namespace App\Http\Requests\user_client;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateUserClient extends FormRequest
{
    public function rules()
    {
        return [
            'shopping_cart_id' => 'required|numeric|exists:shopping_cart,shopping_cart_id',
            'user_id' => 'required|numeric|exists:user,user_id',
        ];
    }
}
