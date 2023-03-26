<?php

namespace App\Http\Requests\person;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidatePersonOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'dni' => 'max:12|regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i|unique:person,dni',
            'name' => 'min:2|max:50|regex:/^[\pL\s]+$/u',
            'surname' => 'min:2|max:50|regex:/^[\pL\s]+$/u',
            'email' => 'email|unique:person,email',
            'telephone' => 'min:9|max:50',
            'user_id' => 'numeric|exists:user,user_id'
        ];
    }
}
