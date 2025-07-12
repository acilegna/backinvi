<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   /*  public function authorize() 
    {
       // return false;
       return true;
    }
 */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:invitados,telefono',
            'categoria' => 'required|string|max:6',
            'status' => 'required|string|max:2'
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',
            'categoria.required' => 'La categoria es obligatoria.',
            'status.required' => 'El status es obligatorio.'
             
        ];
    }
}
