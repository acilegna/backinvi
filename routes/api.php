<?php

use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;





Route::post('/import', [ImportController::class, 'import']);
Route::middleware('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'API funcionando']);
    });
    Route::post('/send-whatsapp', [ImportController::class, 'sendMessage']);
});