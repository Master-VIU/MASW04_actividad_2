<?php

namespace App\Http\Requests\client_address;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

class RequestValidateClientAddressOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'client_id' => 'numeric|exists:user_client,user_client_id',
            'address_id' => 'numeric|exists:address,address_id',
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
