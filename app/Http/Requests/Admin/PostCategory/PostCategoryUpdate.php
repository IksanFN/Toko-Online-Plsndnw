<?php

namespace App\Http\Requests\Admin\PostCategory;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}