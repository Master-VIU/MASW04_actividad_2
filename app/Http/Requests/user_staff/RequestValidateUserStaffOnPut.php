<?php

namespace App\Http\Requests\user_staff;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

class RequestValidateUserStaffOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'role' => [
                'regex:/(technician|consultant)/'
            ],
            'user_id' => 'numeric|exists:user,user_id',
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
