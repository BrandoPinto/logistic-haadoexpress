<?php

use App\Http\Controllers\Cliente1\ArticlesController;
use App\Http\Controllers\Cliente1\OrdersController;
use App\Http\Controllers\Cliente1\ResupplyController;
use App\Http\Controllers\Delivery\DeliveryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

       

#Rutas para ADMINISTRADOR

Route::group(['middleware' => 'auth'], function () {
    Route::post('/actualizar-reabastecimiento', [ResupplyController::class, 'update_state'])->name('update.resupply');
    Route::post('/pedidos-asignar-delivery', [OrdersController::class, 'assign_delivery'])->name('assign.delivery');
    Route::post('/article-assign-fulfillment', [ArticlesController::class, 'assign_fulfillment'])->name('assign.fulfillment');
    Route::get('/articulos-listado-general',[ArticlesController::class, 'show_general'])->name('articulos.general');
    Route::get('/pedidos-del-dia',[OrdersController::class, 'show_orders_today'])->name('show.orders.today');
    Route::post('/actualizar-estado-pedido', [OrdersController::class, 'update_order_state'])->name('update.order.state');
    Route::get('/listado-deliveriees', [DeliveryController::class,'show'])->name('show.delivery');

});
