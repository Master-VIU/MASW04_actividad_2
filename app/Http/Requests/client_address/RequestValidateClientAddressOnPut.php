<?php

namespace App\Http\Requests\address;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateClientAddressOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'client_id' => 'numeric|exists:user_client,user_client_id',
            'address_id' => 'numeric|exists:address,address_id',
        ];
    }
}
