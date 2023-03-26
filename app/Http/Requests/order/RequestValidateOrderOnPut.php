<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateOrderOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'price' => 'numeric',
            'order_date' => 'date',
            'shipping_date' => 'date',
            'location' => 'max:250',
            'card_id' => 'numeric|exists:card,card_id',
            'address_id' => 'numeric|exists:address,address_id',
            'client_id' => 'numeric|exists:user_client,user_client_id',
            'shopping_cart_id' => 'numeric|exists:shopping_cart,shopping_cart_id',
        ];
    }
}
