<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'contact_id'   => 'required|exists:contacts,id',
            'pos_number'   => 'required|integer|min:1',
            'number'       => 'required|integer|unique:invoices,number',
            'type'         => 'required|string|max:2',
            'cbte_tipo'    => 'required|integer',
            'date'         => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status'       => 'nullable|in:pending,paid,cancelled',
            'items'        => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|numeric|gt:0',
            'items.*.price'      => 'required|numeric|min:0',
            'items.*.tax_amount' => 'required|numeric|min:0',
            'items.*.total'      => 'required|numeric|min:0',

            'payment_method_id' => 'nullable|exists:payment_methods,id',
            'amount_paid'       => 'nullable|numeric|min:0',
            'bank_account_id'   => 'nullable|exists:bank_accounts,id',
            'payment_reference' => 'nullable|string|max:255',
        ];
    }
}
