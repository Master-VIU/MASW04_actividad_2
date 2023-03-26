<?php

namespace App\Http\Requests\repairment;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateRepairmentOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'description' => 'max:250',
            'request_date' => 'date',
            'repairment_date' => 'date',
            'price' => 'numeric',
            'staff_id' => 'numeric|exists:user_staff,user_staff_id',
            'client_id' => 'numeric|exists:user_client,user_client_id',
        ];
    }
}
