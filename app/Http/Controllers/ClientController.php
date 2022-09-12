<?php

namespace App\Http\Controllers;

use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportPostRequest;

class ClientController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return view('clients');
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
