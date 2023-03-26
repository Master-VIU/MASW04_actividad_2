<?php

namespace App\Http\Requests\shopping_cart_product;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

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

    protected function failedValidation(Validator $validator)
    {
        $resultResponse = new ResultResponse();
        $resultResponse->setStatus(ResultResponse::UNPROCESSABLE_CONTENT);
        $resultResponse->setData($validator->errors());
        throw new HttpResponseException(response()->json($resultResponse,
         Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
