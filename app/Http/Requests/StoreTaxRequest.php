<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaxRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:taxes,name',
            'percentage' => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del impuesto es obligatorio.',
            'name.unique' => 'Este impuesto ya existe.',
            'percentage.required' => 'Debes ingresar un porcentaje.',
            'percentage.numeric' => 'El porcentaje debe ser un número.',
            'percentage.min' => 'El porcentaje no puede ser menor a 0.',
            'percentage.max' => 'El porcentaje no puede ser mayor a 100.',
        ];
    }
}
