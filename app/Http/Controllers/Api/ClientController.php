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
        $client = Client::where('rut', $rut)->first();

        if ($client) {
            $walletsArray = [];
            $debts = $client->debts;

            foreach ($debts as $debt) {
                $aux = [];
                if ($debt->wallet->name == 'Banco Falabella') {
                    $aux = [
                        "origen" => $debt->wallet->name,
                        "deuda" => ($debt->debt != 0),
                        "monto_deuda" => $debt->debt,
                        "Vencimiento" => "".date('d/m/Y', strtotime($debt->expiration))
                    ];
                } else {
                    $aux = [
                        "origen" => $debt->wallet->name,
                        "deuda" => ($debt->debt != 0),
                        "monto_deuda" => $debt->debt,
                        "4digitos" => $debt->digits,
                        "vencimiento" => "".date('d/m/Y', strtotime($debt->expiration))
                    ];
                }
                $walletsArray[] = $aux;
            }

            $result = [
                "nombre" => $client->name,
                "apellido1" => $client->last_name,
                "apellido2" => $client->second_last_name,
                "carteras" => $walletsArray,
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
                'message' => 'No existe el cliente',
                'code' => 200,
                'data' => false
            ]);
        }
    }
}
