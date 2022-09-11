<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'required|max:5000',
            'file' => 'required|mimes:csv,txt,xls,xlsx'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file.required' => 'Es requerido la carga de un archivo',
            'file.max' => 'El archivo supera el máximo de 2mb',
            'file.mimes' => 'El archivo no tiene formato valido',
        ];
    }
}
