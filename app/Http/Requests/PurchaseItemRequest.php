<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseItemRequest extends FormRequest
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
            'purchase_id'   => 'required|exists:purchases,id',
            'product_id'   => 'required|exists:products,id',
            'quantity'         => 'required|numeric',
            'cost_price'       => 'required|numeric',
            'tax_amount'       => 'required|numeric',
            'subtotal' => 'required|numeric|min:0',
            'notes'        => 'nullable|string'
        ];
    }
}
