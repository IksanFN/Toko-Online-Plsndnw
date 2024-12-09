<?php

namespace App\Http\Requests\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'thumbnail' => ['required', 'image', 'max:2048', 'mimes:png,jpg,jpeg', 'mimetypes:image/png,image/jpg,imagejpeg'],
            'title' => ['required', 'string'],
            'tagline' => ['required', 'string'],
            'content' => ['nullable', 'string']
        ];
    }
}
