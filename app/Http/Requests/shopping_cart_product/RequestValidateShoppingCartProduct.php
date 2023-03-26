<?php

namespace App\Http\Requests\shopping_cart_product;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

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

    protected function failedValidation(Validator $validator)
    {
        $resultResponse = new ResultResponse();
        $resultResponse->setStatus(ResultResponse::UNPROCESSABLE_CONTENT);
        $resultResponse->setData($validator->errors());
        throw new HttpResponseException(response()->json($resultResponse,
         Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
