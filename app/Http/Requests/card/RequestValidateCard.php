<?php

namespace App\Http\Requests\card;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateCard extends FormRequest
{
    public function rules()
    {
        return [
            'card_number' => 'required|unique:card,card_number',
            'type' => [
                'required',
                'regex:/(credit|debit)/',
            ],
            'cvv' => 'required|numeric',
            'expiration_date' => 'required|date',
            'user_client_id' => 'required|numeric|exists:user_client,user_client_id',
        ];
    }
}
