<?php

namespace App\Http\Requests\card;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateCardOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'card_number' => 'unique:card,card_number',
            'type' => [
                'regex:/(credit|debit)/',
            ],
            'cvv' => 'numeric',
            'expiration_date' => 'date',
            'user_client_id' => 'numeric|exists:user_client,user_client_id',
        ];
    }
}
