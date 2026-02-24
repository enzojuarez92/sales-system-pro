<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
    // Capturamos el ID del contacto si estamos en un Update
    $contactId = $this->route('contact') ? $this->route('contact')->id : null;

    return [
        'tax_condition_id'      => 'required|exists:tax_conditions,id',
        'first_name'            => 'required|string|max:100',
        'last_name'             => 'nullable|string|max:100',
        
        // El número de identificación es único, pero ignoramos el actual si es un Update
        'identification_number' => [
            'nullable',
            'string',
            'max:20',
            'unique:contacts,identification_number,' . $contactId
        ],
        
        'email'                 => [
            'nullable',
            'email',
            'max:255',
            'unique:contacts,email,' . $contactId
        ],
        
        'phone'                 => 'nullable|string|max:50',
        'address'               => 'nullable|string|max:255',
        'city'                  => 'nullable|string|max:100',
        'is_customer'           => 'required|boolean',
        'is_supplier'           => 'required|boolean',
        'is_active'             => 'nullable|boolean',
    ];
}

public function messages(): array
{
    return [
        'tax_condition_id.required' => 'La condición fiscal es obligatoria.',
        'tax_condition_id.exists'   => 'La condición fiscal seleccionada no es válida.',
        'first_name.required'       => 'El nombre (o razón social) es obligatorio.',
        'identification_number.unique' => 'Este número de identificación ya está registrado.',
        'email.unique'              => 'Este correo electrónico ya está en uso.',
    ];
}
}
