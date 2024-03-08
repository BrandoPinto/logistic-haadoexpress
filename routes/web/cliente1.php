<?php

use App\Http\Controllers\Cliente1\ArticlesController;
use App\Http\Controllers\Cliente1\OrdersController;
use App\Http\Controllers\Cliente1\ResupplyController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

       

#Rutas para ADMINISTRADOR

Route::group(['middleware' => 'auth'], function () {
	Route::get('/reabastecimiento',[ResupplyController::class,'show'])->name('reabastecimiento');
    Route::get('/reabastecimiento-formulario',[ResupplyController::class,'resupply_form'])->name('resupply.form');
    Route::post('/reabasticimiento-nuevo', [ResupplyController::class, 'store'])->name('resupply.store');
    Route::post('/reabastecimiento-detalle', [ResupplyController::class, 'resupply_detail'])->name('resupply.detail');
    Route::get('/articulos', [ArticlesController::class, 'show'])->name('articulos');
    Route::post('/articulos-nuevo',[ArticlesController::class, 'store'])->name('article.store');
    Route::post('/articulos-actualizar',[ArticlesController::class, 'update'])->name('article.update');
    Route::get('/pedidos', [OrdersController::class, 'show'])->name('pedidos');
    Route::get('/pedidos-formulario', [OrdersController::class, 'orders_form'])->name('orders.form');
    Route::post('/pedidos-nuevo',[OrdersController::class, 'orders_store'])->name('orders.store');
    Route::post('/pedidos-detalle', [OrdersController::class, 'order_detail'])->name('order.detail');
    Route::post('/pedidos-buscar', [OrdersController::class, 'order_search'])->name('order.search');
    Route::post('/select/value/city',[OrdersController::class,'search_select_city']);
    Route::get('/pedidos-historial',[OrdersController::class,'show_orders_history'])->name('orders.history');
 

    
});
