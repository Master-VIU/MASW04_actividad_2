<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateUserOnUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required|min:8|max:100',
        ];
    }
}
