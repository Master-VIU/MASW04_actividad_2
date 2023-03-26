<?php

namespace App\Http\Requests\order;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

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

    protected function failedValidation(Validator $validator)
    {
        $resultResponse = new ResultResponse();
        $resultResponse->setStatus(ResultResponse::UNPROCESSABLE_CONTENT);
        $resultResponse->setData($validator->errors());
        throw new HttpResponseException(response()->json($resultResponse,
         Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
