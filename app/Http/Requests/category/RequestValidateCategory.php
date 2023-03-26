<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;

class RequestValidateCategory extends FormRequest
{
    public function rules()
    {
        return [
            'name_category' => 'required|unique:category|max:250',
            'parent_category_id' => 'exists:category,category_id',
        ];
    }
}
