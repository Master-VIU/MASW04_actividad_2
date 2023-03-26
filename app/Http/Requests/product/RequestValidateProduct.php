<?php

namespace App\Http\Requests\product;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

class RequestValidateProduct extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required|numeric|exists:category,category_id',
            'name' => 'required|max:100',
            'description' => 'required|max:250',
            'price' => 'required|numeric',
            'properties' => 'required|max:250',
            'stock' => 'required|numeric',
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
