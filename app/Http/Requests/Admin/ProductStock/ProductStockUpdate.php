<?php

namespace App\Http\Requests\Admin\ProductStock;

use Illuminate\Foundation\Http\FormRequest;

class ProductStockUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'size' => ['required', 'string', 'not_in:default'],
        ];
    }
}
