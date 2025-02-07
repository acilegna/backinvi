<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

//rutas importar archivo
Route::get('/importar', [ImportController::class, 'formImportar']);
Route::post('/importar', [ImportController::class, 'import'])->name('import');

//ruta mostrar invitacion
 Route::get('/', [ImportController::class, 'showInvitado'])->name('invitado');


//ruta enviar confirmacion de asistencia
Route::get('/sendConfirmation', [ImportController::class, 'confirmar'])->name('change.status');

//ruta mostrar vista enviar mensaje
Route::get('/send-message', function () {
    return view('send-message');
});


//ruta enviar mensaje
Route::post('/send-whatsapp', [ImportController::class, 'sendMessage'])->name('send.whatsapp');