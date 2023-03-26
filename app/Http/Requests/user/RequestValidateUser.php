<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateUser extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|unique:user',
            'password' => 'required|min:8|max:100',
        ];
    }
}
