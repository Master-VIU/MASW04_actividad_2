<?php

namespace App\Http\Requests\client_address;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateClientAddress extends FormRequest
{
    public function rules()
    {
        return [
            'client_id' => 'required|numeric|exists:user_client,user_client_id',
            'address_id' => 'required|numeric|exists:address,address_id',
        ];
    }
}
