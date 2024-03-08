<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function show(){

        $users = User::where('id_rol',3)->get();
        return view('roles.almacenero.pages.deliveries', compact('users'));
    }

    public function show_orders(){
        $id_user = Auth::id();
        $orders = Order::where('idUser', $id_user)->get();
        
        return view('roles.delivery.pages.orders', compact('orders'));
    }
}
