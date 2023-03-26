<?php

namespace App\Http\Requests\repairment;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateRepairment extends FormRequest
{
    public function rules()
    {
        return [
            'description' => 'required|max:250',
            'request_date' => 'required|date',
            'repairment_date' => 'required|date',
            'price' => 'required|numeric',
            'staff_id' => 'required|numeric|exists:user_staff,user_staff_id',
            'client_id' => 'required|numeric|exists:user_client,user_client_id',
        ];
    }
}
