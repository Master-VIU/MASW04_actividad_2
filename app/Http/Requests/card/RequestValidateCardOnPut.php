<?php

namespace App\Http\Requests\card;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

class RequestValidateCardOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'card_number' => 'unique:card,card_number',
            'type' => [
                'regex:/(credit|debit)/',
            ],
            'cvv' => 'numeric',
            'expiration_date' => 'date',
            'user_client_id' => 'numeric|exists:user_client,user_client_id',
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
