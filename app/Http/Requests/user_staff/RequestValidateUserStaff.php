<?php

namespace App\Http\Requests\user_staff;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateUserStaff extends FormRequest
{
    public function rules()
    {
        return [
            'role' => [
                        'required',
                        'regex:/(technician|consultant)/'],
            'user_id' => 'required|numeric|exists:user,user_id',
        ];
    }
}
