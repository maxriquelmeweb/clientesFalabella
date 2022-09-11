<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log;

class ClientsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        try {
            $clients = Client::join('debts', 'clients.id', '=', 'debts.client_id')
                ->join('wallets', 'wallets.id', '=', 'debts.wallet_id')
                ->where('clients.is_active',1)
                ->select('clients.rut', 'clients.name as client_name', 'clients.last_name', 'clients.second_last_name', 'debts.debt', 'wallets.name as wallet_name', 'debts.digits')
                ->orderby('clients.id')->get();
            return $clients;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Rut", "Nombre", "Apellido1", "Apellido2", "monto deuda", "cartera", "4digitos"];
    }
}
