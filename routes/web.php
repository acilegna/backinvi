<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/importar', [ImportController::class, 'showForm']);
Route::post('/importar', [ImportController::class, 'import'])->name('import');

Route::get('/', [ImportController::class, 'showInvitado']);


Route::get('/ejecutar-funcion', [ImportController::class, 'confirmar'])->name('ejecutar.funcion');

Route::get('/send-message', function () {
    return view('send-message');
});

Route::post('/send-whatsapp', [ImportController::class, 'sendMessage'])->name('send.whatsapp');