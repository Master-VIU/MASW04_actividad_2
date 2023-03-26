<?php

namespace App\Http\Requests\user_staff;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateUserStaffOnPut extends FormRequest
{
    public function rules()
    {
        return [
            'role' => [
                'regex:/(technician|consultant)/'
            ],
            'user_id' => 'numeric|exists:user,user_id',
        ];
    }
}
