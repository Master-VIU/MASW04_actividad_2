<?php

namespace App\Http\Requests\person;

use App\Models\ResultResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Contracts\Validation\Validator;

class RequestValidatePerson extends FormRequest


{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dni' => 'required|max:12|regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i|unique:person,dni',
            'name' => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
            'surname' => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|unique:person,email',
            'telephone' => 'required|min:9|max:50',
            'user_id' => 'required|numeric|exists:user,user_id'
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
