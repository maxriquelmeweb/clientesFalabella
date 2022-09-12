<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;
use Illuminate\Support\Facades\Log;

class ClientPagination extends Component
{
    use WithPagination;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        try {
            $query = Client::join('debts', 'clients.id', '=', 'debts.client_id')
                ->join('wallets', 'wallets.id', '=', 'debts.wallet_id')
                ->where('clients.is_active', 1)
                ->select('clients.id', 'clients.rut', 'clients.name as client_name', 'clients.last_name', 'clients.second_last_name', 'debts.debt', 'debts.digits', 'wallets.name as wallet_name')
                ->orderby('clients.id');
            $clients = $query->paginate(10);
            return view('livewire.client-pagination', [
                'clients' => $clients,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
