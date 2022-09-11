<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\Debt;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientsImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{

    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //buscamos el cliente eliminado o existente, luego lo actualizamos o creamos
        $client = Client::withTrashed()->updateOrCreate(
            ['rut'     => $row['rut']],
            [
                'rut'     => $row['rut'],
                'name'     => $row['nombre'],
                'last_name'     => $row['apellido1'],
                'second_last_name'     => $row['apellido2'],
                'deleted_at' => null
            ]
        );

        $walletId = $row['cartera'] == "cmr Falabella" ? 1 : 2;

        //actualizamos su deuda o la creamos
        Debt::withTrashed()->updateOrCreate(
            ['client_id'     => $client->id, 'wallet_id' => $walletId],
            [
                'debt'     => $row['monto_deuda'],
                'digits' => $row['4digitos'],
                'client_id'     => $client->id,
                'wallet_id'     => $walletId,
                'deleted_at' => null
            ]
        );

        return $client;
    }

    public function rules(): array
    {
        return [
            'rut' => [
                'required',
                'numeric',
                'min:100000',
                'max:999999999'
            ],
            'nombre' => [
                'required',
                'string',
                'max:50'
            ],
            'apellido1' => [
                'string',
                'max:50'
            ],
            'apellido2' => [
                'string',
                'max:50'
            ],
            'monto_deuda' => [
                'required',
                'numeric',
                'digits_between:1,10'
            ],
            'cartera' => [
                'required',
                'string',
                'in:cmr Falabella,Banco Falabella'
            ],
            '4digitos' => [
                'numeric',
                'digits:4'
            ]
        ];
    }
}
