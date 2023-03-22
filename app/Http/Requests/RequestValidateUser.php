<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateUser extends FormRequest
{

     public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required|min:5',
        ];
    }
}
