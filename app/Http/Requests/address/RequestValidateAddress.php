<?php

namespace App\Http\Requests\address;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateAddress extends FormRequest
{
    public function rules()
    {
        return [
            'street' => 'required|max:200',
            'street_number' => 'required|numeric',
            'city' => 'required|max:100',
            'postal_code' => 'required|numeric',
        ];
    }
}
