<?php

namespace App\Http\Requests\repairment;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;


class RequestValidateRepairment extends FormRequest
{
    public function rules()
    {
        return [
            'description' => 'required|max:250',
            'request_date' => 'required|date',
            'repairment_date' => 'required|date',
            'price' => 'required|numeric',
            'staff_id' => 'required|numeric|exists:user_staff,user_staff_id',
            'client_id' => 'required|numeric|exists:user_client,user_client_id',
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
