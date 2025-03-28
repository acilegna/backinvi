<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

//rutas importar archivo
Route::get('/importar', [ImportController::class, 'formImportar']);
 
Route::get('/pruebas', [ImportController::class, 'pruebas']);
Route::post('/importar', [ImportController::class, 'import'])->name('import');

//ruta mostrar invitacion
Route::get('/', [ImportController::class, 'showInvitado'])->name('invitado');

Route::get('/home', [HomeController::class, 'viewHome'])->name('home');
//ruta enviar confirmacion de asistencia
//Route::get('/sendConfirmation', [ImportController::class, 'confirmar'])->name('change.status');

Route::post('/sendConfirmation', [ImportController::class, 'confirmar'])->name('change.status');

//ruta mostrar vista enviar mensaje
Route::get('/send-message', function () {
    return view('send-message');
});


//ruta enviar mensaje
Route::post('/send-whatsapp', [ImportController::class, 'sendMessage'])->name('send.whatsapp');

Route::get('/detalles', [ImportController::class, 'detalles'])->name('detalle');