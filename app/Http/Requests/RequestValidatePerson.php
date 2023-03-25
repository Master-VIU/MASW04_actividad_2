<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'dni' => 'required|max:12|unique:person|regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i',
            'name' => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
            'surname' => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|unique:person',
            'telephone' => 'required|min:9|max:50',
        ];
    }
}
