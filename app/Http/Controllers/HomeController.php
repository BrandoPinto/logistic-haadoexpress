<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $id_user = Auth::id();
        $blog = Blog::where('state', 1)->get();

        $currentMonth = Carbon::now()->format('Y-m'); // Mes actual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $weeklyIncomes = Order::where('state', 1)
        ->where('idUser', $id_user)
        ->where('real_date', '>=', $startOfMonth)
        ->where('real_date', '<', $endOfMonth)
        ->selectRaw("YEAR(real_date) as year, WEEK(real_date, 1) as week, SUM(amount) as total")
        ->groupBy('year', 'week')
        ->get();
    



        return view('pages.dashboard', compact('blog', 'weeklyIncomes'));
    }
}
