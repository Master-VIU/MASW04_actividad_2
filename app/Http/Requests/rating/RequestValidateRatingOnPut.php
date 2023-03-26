<?php

namespace App\Http\Requests\rating;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

class RequestValidateRatingOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'rate' => 'numeric',
            'opinion' => 'max:250',
            'date' => 'date',
            'user_client_id' => 'numeric|exists:user_client,user_client_id',
            'product_id' => 'numeric|exists:product,product_id',
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
