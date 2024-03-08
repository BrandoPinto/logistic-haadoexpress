<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\District;
use App\Models\Fulfillment;
use App\Models\Order;
use App\Models\OrdersArticle;
use App\Models\OrdersType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Lang;

class AccountingController extends Controller
{
    public function show()
    {
        $now = Carbon::now();
        $months = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];
        $monthName = $months[$now->month - 1];

        // Construye el rango de fechas para el mes actual
        $startOfMonth = $now->startOfMonth()->toDateString();
        $endOfMonth = $now->endOfMonth()->toDateString();

        $currentYear = Carbon::now()->year;

        $orders = Order::join('orders_article', 'orders.idOrders', '=', 'orders_article.idOrders')
            ->whereBetween('orders.date_delivery', [$startOfMonth, $endOfMonth])
            ->get();
        $articles = Article::join('fulfillment', 'articles.idFulfillment', '=', 'fulfillment.idFulfillment')
            ->whereNotNull('articles.idFulfillment')
            ->get();
        $tariffs = District::all();


        return view('roles.admin.pages.accounting_general', compact('orders', 'articles', 'monthName', 'currentYear', 'tariffs'));
    }

    public function search_accounting(Request $request)
    {
        $month = $request->input('month');
        $currentYear = $request->input('year');
        $monthsInSpanish = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];
    
        $monthName = ucfirst($monthsInSpanish[$month - 1]);

        $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth()->toDateString();
        $endOfMonth = Carbon::create($currentYear, $month, 1)->endOfMonth()->toDateString();

        $orders = Order::join('orders_article', 'orders.idOrders', '=', 'orders_article.idOrders')
            ->whereBetween('orders.date_delivery', [$startOfMonth, $endOfMonth])
            ->get();
        $articles = Article::join('fulfillment', 'articles.idFulfillment', '=', 'fulfillment.idFulfillment')
            ->whereNotNull('articles.idFulfillment')
            ->get();
        $tariffs = District::all();

        return view('roles.admin.pages.accounting_general', compact('orders', 'articles', 'monthName', 'currentYear', 'tariffs'));
    }


    public function show_accounting_customer()
    {
        $orders = Order::all();
        $users = User::whereIn('id_rol', [4, 5, 6])->get();

        return view('roles.admin.pages.accounting_user', compact('orders', 'users'));
    }

    public function accounting_customer_detail(Request $request)
    {
        $idUser = $request->input('id');

        $orders = Order::where('idUser', $idUser)->get();
        $user = User::find($idUser);
        $order_type = OrdersType::all();

        $total_customer = 0;
        foreach ($orders as $order) {
            if ($order->state == 1) {
                $total_customer += $order->amount;
            }
        }

        return view('roles.admin.pages.accounting_user_detail', compact('orders', 'user', 'order_type', 'total_customer'));
    }

    public function total_discount_tariff($idOrders)
    {
        $totalTariff = Order::join('districts', 'orders.idDistrict', '=', 'districts.idDistrict')
            ->where('orders.idOrders', $idOrders)
            ->sum('districts.tariff');

        return $totalTariff;
    }

    public function total_discount_fulfillment($idOrders)
    {
        $totalFulfillment = OrdersArticle::join('articles', 'orders_article.idArticle', '=', 'articles.idArticle')
            ->join('fulfillment', 'articles.idFulfillment', '=', 'fulfillment.idFulfillment')
            ->where('orders_article.idOrders', $idOrders)
            ->whereNotNull('articles.idFulfillment')
            ->sum('fulfillment.amount');

        return $totalFulfillment;
    }
}
