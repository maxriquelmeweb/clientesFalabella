<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Wallet;
use App\Models\Debt;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerDatosCliente(Request $request)
    {
        $rut = $request->rut;
        $client = Client::where('rut','=', $rut)->first();
        
        if ($client->count()) {
            $debts = $client->debts;
            $walletsArray = [];

            foreach ($debts as $debt) {
                $walletsArray[] = $debt->wallet;
            }
            $result = [
                "Nombre" => $client->name,
                "Apellido1" => $client->last_name,
                "Apellido2" => $client->second_last_name,
                "Deuda" => $debts,
            ];

            return response()->json([
                'status' => 'Success',
                'message' => 'Datos del cliente',
                'code' => 200,
                'data' => $result
            ]);
        } else {
            return response()->json([
                'status' => 'Success',
                'message' => 'No existen datos del cliente',
                'code' => 200,
                'count' => 0,
                'data' => 0
            ]);
        }
    }
}
