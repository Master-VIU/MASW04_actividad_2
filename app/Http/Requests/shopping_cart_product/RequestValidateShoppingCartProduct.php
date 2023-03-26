<?php

namespace App\Http\Requests\shopping_cart_product;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateShoppingCartProduct extends FormRequest
{
    public function rules()
    {
        return [
            'shopping_cart_id' => 'required|numeric|exists:shopping_cart,shopping_cart_id',
            'product_id' => 'required|numeric|exists:product,product_id',
            'quantity' => 'required|numeric',
        ];
    }
}
