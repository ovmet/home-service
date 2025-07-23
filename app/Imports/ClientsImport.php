<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Client([
            'name' => $row['nombre'] ?? $row['name'] ?? '',
            'phone' => $row['telefono'] ?? $row['phone'] ?? '',
            'email' => $row['email'] ?? '',
            'address' => $row['direccion'] ?? $row['address'] ?? '',
            'notes' => $row['notas'] ?? $row['notes'] ?? '',
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required',
            'telefono' => 'nullable',
            'email' => 'nullable|email',
            'direccion' => 'nullable',
            'notas' => 'nullable',
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'nombre.required' => 'El nombre del cliente es obligatorio.',
            'email.email' => 'El email debe tener un formato válido.',
        ];
    }
}
