<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryMovementRequest extends FormRequest
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
            'product_id' => 'required|exists:products,product_id',
            'quantity'   => 'required|numeric|not_in:0',
            'concept'    => 'nullable|string|max:255',
            'movable_id'   => 'nullable|integer',
            'movable_type' => 'nullable|string',
        ];
    }
}
