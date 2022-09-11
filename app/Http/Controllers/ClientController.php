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
        $clients = Client::get();

        return view('clients', compact('clients'));
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
        //desactivamos todos los clientes, para poder dejar activos los actuales que importamos
        Client::where('is_active', 1)->update(['is_active' => 0]);
        Excel::import(new ClientsImport, $request->file);
        return back()->with('success', 'Carga exitosa.');
    }
}
