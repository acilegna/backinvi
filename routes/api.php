<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\ApiController;

use Illuminate\Support\Facades\Route;



//http://127.0.0.1:8000/api/productos
//Si es un controlador API:
//Route::apiResource('productos', ApiController::class);
//Si es un controlador normal (para vistas):
//Route::get('/productos', [ApiController::class, 'index']);


//genera automáticamente las siguientes rutas POST,GET,PUT DELETE
Route::apiResource('invitados', ApiController::class);

Route::middleware('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'APIs funcionando']);
    });
    Route::post('/send-whatsapp', [ImportController::class, 'sendMessage']);
    // confirmados
    Route::get('asistiran', [ApiController::class, 'confirmados']);

    // No asistiran
    Route::get('no', [ApiController::class, 'ausentes']);

    // total invitados
    Route::get('total', [ApiController::class, 'totalInvitados']);

    //pendientes
    Route::get('pendientes', [ApiController::class, 'pendientes']);
    //totalniños
    Route::get('totalNino', [ApiController::class, 'totalNiños']);
    //totalniñosausentes
    Route::get('niñosAusentes', [ApiController::class, 'niñosAusentes']);
    //totaladulto ausente
    Route::get('adultoAusentes', [ApiController::class, 'adultosAusentes']);

    //niño confirmado
    Route::get('niñoConfirmado', [ApiController::class, 'niñosConfirmados']);
    //adulto confirmado
    Route::get('adultoConfirmado', [ApiController::class, 'adultosConfirmados']);


    //niño pendiente
    Route::get('niñoPendiente', [ApiController::class, 'niñosPendientes']);
    //adulto pendiente
    Route::get('adultoPendiente', [ApiController::class, 'adultosPendientes']);

    //totaladukto
    Route::get('totalAdulto', [ApiController::class, 'totalAdulto']);
    //totaladuktoid
    Route::get('totalAdultoId', [ApiController::class, 'totalAdultoById']);
    //totalniñoid
    Route::get('totalNinoId', [ApiController::class, 'totalNinoById']);
    //updatesttaus
    Route::put('update/{id}', [ApiController::class, 'updateStatus']);

    Route::post('/import', [ApiController::class, 'import']);
 
    Route::get('byFamily/{id}', [ApiController::class, 'byFamily']);

  

});
