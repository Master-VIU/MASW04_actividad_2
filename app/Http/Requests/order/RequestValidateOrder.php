<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateOrder extends FormRequest
{
    public function rules()
    {
        return [
            'price' => 'required|numeric',
            'order_date' => 'required|date',
            'shipping_date' => 'required|date',
            'location' => 'required|max:250',
            'card_id' => 'required|numeric|exists:card,card_id',
            'address_id' => 'required|numeric|exists:address,address_id',
            'client_id' => 'required|numeric|exists:user_client,user_client_id',
            'shopping_cart_id' => 'required|numeric|exists:shopping_cart,shopping_cart_id',
        ];
    }
}
