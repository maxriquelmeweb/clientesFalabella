<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\Debt;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

ini_set('max_execution_time', 3600);
ini_set('memory_limit', '2048M');

class ClientsImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, WithChunkReading
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            //buscamos el cliente luego lo actualizamos o creamos
            $client = Client::updateOrCreate(
                ['rut' => $row['rut']],
                [
                    'rut'  => $row['rut'],
                    'name'  => $row['nombre'],
                    'last_name'  => $row['apellido1'],
                    'second_last_name'  => $row['apellido2'],
                ]
            );
            $walletId = $row['cartera'] == "cmr Falabella" ? 1 : 2;
            //actualizamos su deuda o la creamos
            Debt::updateOrCreate(
                ['client_id'     => $client->id, 'wallet_id' => $walletId],
                [
                    'debt' => $row['monto_deuda'],
                    'digits' => $row['4digitos'],
                    'expiration' => Carbon::parse($row['vencimiento'])->format('Y/m/d'),
                    'client_id' => $client->id,
                    'wallet_id' => $walletId,
                ]
            );
            return $client;
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'Error leyendo archivo');
        }
    }

    public function chunkSize(): int
    {
        return 1000;
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
                'nullable',
                'string',
                'max:50'
            ],
            'apellido2' => [
                'nullable',
                'string',
                'max:50'
            ],
            'monto_deuda' => [
                'required',
                'numeric',
                'digits_between:1,10',
                'min:0'
            ],
            '4digitos' => [
                'nullable',
                'numeric',
                'digits:4'
            ],
            'cartera' => [
                'required',
                'string',
                'in:cmr Falabella,Banco Falabella'
            ],
            'vencimiento' => [
                'nullable',
                'date_format:d-m-Y'
            ]
        ];
    }
}
