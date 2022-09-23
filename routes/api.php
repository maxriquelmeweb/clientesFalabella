<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["middleware" => "apikey.validate"], function () {
    //Ruta para obtener cliente con sus datos
    Route::post("obtenerDatosCliente", [ClientController::class, "obtenerDatosCliente"]);
});
