<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Invitado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvitadosImport implements ToModel, WithHeadingRow

{
    /**
     * @param Collection $collection
     */

    public function model(array $row)
    {
        return new Invitado([

            'name'     => $row['name'],
            'apellido'    => $row['apellido'],
            'email'    => $row['email'],
            'telefono'     => $row['telefono'],
            'pases'     => $row['pases'],
            'status'     => $row['status'],

        ]);
    }
}