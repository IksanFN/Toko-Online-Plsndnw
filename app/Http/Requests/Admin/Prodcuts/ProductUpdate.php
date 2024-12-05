<?php

namespace App\Http\Requests\Admin\Prodcuts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'sku' => ['required', Rule::unique('products', 'sku')->ignore($this->product->id)],
            'thumbnail' => ['sometimes', 'image', 'mimes:jpg,jpeg,png', 'max:3024', 'mimetypes:image/jpeg,image/png'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ];
    }
}
