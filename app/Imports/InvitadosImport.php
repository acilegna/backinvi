<?php

namespace App\Imports;

use Illuminate\Support\Collection;

use App\Models\Invitado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class InvitadosImport implements ToModel, WithHeadingRow, WithValidation


{
    /**
     * @param Collection $collection
     */

    public function model(array $row)
    {
        return new Invitado([

            'id_familia'     => $row['id_familia'],
            'name'     => $row['name'],
            'apellido'    => $row['apellido'],
            'telefono'     => $row['telefono'],
            'categoria'     => $row['categoria'],

        ]);
    }



    // Definir reglas de validación
    public function rules(): array
    {
        return [
            'id_familia' => 'required',
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|max:20|unique:invitados,telefono',
            'categoria' => 'required|string|max:6'
        ];
    }

    // Mensajes personalizados
    public function customValidationMessages()
    {
        return [
            'id_familia.required' => 'El id familia es obligatorio.',
            'name.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',
            'categoria.required' => 'La categoria es obligatorio.',
        ];
    }
}
