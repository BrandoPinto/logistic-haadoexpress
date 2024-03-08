<?php

use App\Http\Controllers\Admin\AccountingController;
use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientesController;
use App\Http\Controllers\Cliente1\OrdersController;
use App\Http\Controllers\Cliente1\ResupplyController;
use App\Http\Controllers\PageController;

       

#Rutas para ADMINISTRADOR

Route::group(['middleware' => 'auth'], function () {
	Route::get('/clientes',[ClientesController::class,'show'])->name('clientes');
    Route::post('/crear/cliente',[ClientesController::class, 'store'])->name('new.customer');
    Route::post('/crear/subemail',[ClientesController::class, 'new_subemail'])->name('new.subemail');
    Route::post('/eliminar/subemail',[ClientesController::class, 'delete_subemail'])->name('delete.subemail');
    Route::post('/clientes/historial', [ClientesController::class, 'customer_history'])->name('customer.history');
    Route::post('/clientes-perfil',[ClientesController::class,'customer_profile'])->name('customer.profile');
    Route::post('/clientes-perfil-update', [ClientesController::class, 'customer_profile_update'])->name('customer.profile.update');
    Route::post('/clientes-perfil-update-photo', [ClientesController::class, 'customer_profile_update_photo'])->name('customer.profile.update.photo');
    Route::post('/clientes/baja', [ClientesController::class, 'customer_terminate'])->name('customer.terminate');
    Route::get('/blog',[BlogController::class,'show'])->name('blog');
    Route::post('/blog-nuevo',[BlogController::class,'store'])->name('blog.store');
    Route::post('/blog-actualizar-image',[BlogController::class, 'update_image'])->name('update.image');
    Route::get('/pedidos-general', [OrdersController::class, 'show_admin'])->name('orders.admin');
    Route::get('/reabastecimiento-general', [ResupplyController::class, 'show_admin'])->name('resupply.admin');
    Route::get('/mi-contabilidad', [AccountingController::class,'show'])->name('show.accounting');
    Route::post('/mi-contabilidad-buscar', [AccountingController::class, 'search_accounting'])->name('search.accounting');
    Route::get('/clientes-contabilidad', [AccountingController::class,'show_accounting_customer'])->name('show.accounting.customer');
    Route::post('/clientes-contabilidad-detallado', [AccountingController::class, 'accounting_customer_detail'])->name('accounting.customer.detail');
});
