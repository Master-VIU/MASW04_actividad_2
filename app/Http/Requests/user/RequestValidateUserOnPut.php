<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateUserOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'unique:user',
            'password' => 'min:8|max:100',
        ];
    }
}
