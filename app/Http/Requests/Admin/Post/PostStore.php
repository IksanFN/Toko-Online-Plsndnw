<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStore extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'post_category_id' => ['required', 'integer'],
            'thumbnail' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048', 'mimetypes:image/jpeg,image/png'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'status' => ['required', 'not_in:default'],
        ];
    }
}
