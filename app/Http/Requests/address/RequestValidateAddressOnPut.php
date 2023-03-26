<?php

namespace App\Http\Requests\address;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateAddressOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'street' => 'max:200',
            'street_number' => 'numeric',
            'city' => 'max:100',
            'postal_code' => 'numeric',
        ];
    }
}
