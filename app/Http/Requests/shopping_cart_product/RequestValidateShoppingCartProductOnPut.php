<?php

namespace App\Http\Requests\shopping_cart_product;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateShoppingCartProductOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'shopping_cart_id' => 'numeric|exists:shopping_cart,shopping_cart_id',
            'product_id' => 'numeric|exists:product,product_id',
            'quantity' => 'numeric',
        ];
    }
}
