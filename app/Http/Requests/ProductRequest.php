<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $productId = $this->route('product')?->id;

        return [
            'category_id' => 'required|numeric|exists:categories,id',
            'tax_id' => 'required|numeric|exists:taxes,id',
            'name' => ['required', 'max:50', Rule::unique('products', 'name')->ignore($productId)],
            'slug' => 'nullable|string',
            'description' => 'required|max:255',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'alert_quantity' => 'nullable|integer',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048' // max 2MB
        ];
    }
}
