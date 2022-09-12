<?php

namespace App\Http\Controllers;

use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Client;
use App\Http\Requests\ImportPostRequest;

class ClientController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        $query = Client::join('debts', 'clients.id', '=', 'debts.client_id')
            ->join('wallets', 'wallets.id', '=', 'debts.wallet_id')
            ->where('clients.is_active', 1)
            ->select('clients.id', 'clients.rut', 'clients.name as client_name', 'clients.last_name', 'clients.second_last_name', 'debts.debt', 'debts.digits', 'wallets.name as wallet_name')
            ->orderby('clients.id');
        $clients = $query->paginate(10);
        return view('clients', [
            'clients' => $clients,
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new ClientsExport, 'clientes.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(ImportPostRequest $request)
    {
        $_SESSION['import'] = 0;
        Excel::import(new ClientsImport, $request->file);
        if ($_SESSION['import'] === 0) {
            return back()->with('error', 'Error al cargar archivo invalido.');
        } else {
            return back()->with('success', 'Carga exitosa.');
        }
    }
}
