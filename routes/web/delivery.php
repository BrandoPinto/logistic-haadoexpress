<?php

use App\Http\Controllers\Delivery\DeliveryController;
use Illuminate\Support\Facades\Route;

       

#Rutas para ADMINISTRADOR

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/listado-pedido-delivery', [DeliveryController::class,'show_orders'])->name('show.orders');
    
});
