<?php

namespace App\Http\Controllers;

use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportPostRequest;
use App\Models\Client;
use App\Models\Debt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        try {
            $clients = Client::join('debts', 'clients.id', '=', 'debts.client_id')
                ->select('clients.id');
            $registerTotal = $clients->count();
            return view('clients', compact('registerTotal'));
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'Error cargando pagina principal');
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        try {
            return Excel::download(new ClientsExport, 'clientes.xlsx');
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'Error exportando archivo');
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(ImportPostRequest $request)
    {
        if(!mb_check_encoding(file_get_contents($request->file), 'UTF-8'))
        return back()->with('error', 'El csv debe estar codificado en UTF-8 revise manual');
        $rows = count(file($request->file));
        if($rows<2)
        return back()->with('error', 'El csv debe contener al menos 2 filas');
        if($rows>150000)
        return back()->with('error', 'El csv no puede contener mas de 150000 filas');
       
        Excel::import(new ClientsImport, $request->file);
        return back()->with('success', 'Carga exitosa');
    }

    public function destroyAll()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            Client::truncate();
            Debt::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            return redirect('/')->with('success', 'Todos los clientes eliminados');
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'Error eliminando los clientes');
        }
    }
}
