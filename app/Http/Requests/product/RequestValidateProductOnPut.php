<?php

namespace App\Http\Requests\product;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

class RequestValidateProductOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'numeric|exists:category,category_id',
            'name' => 'max:100',
            'description' => 'max:250',
            'price' => 'numeric',
            'properties' => 'max:250',
            'stock' => 'numeric',
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
