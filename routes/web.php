<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [ClientController::class, 'index'])->name('dashboard');

    Route::controller(ClientController::class)->group(function () {
        Route::get('clients-export', 'export')->name('clients.export');
        Route::post('clients-import', 'import')->name('clients.import');
    });
});

require __DIR__ . '/auth.php';
