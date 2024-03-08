<?php

namespace App\Http\Controllers\Cliente1;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Article;
use App\Models\City;
use App\Models\District;
use App\Models\DistrictsArequipa;
use App\Models\MethodPayment;
use App\Models\Order;
use App\Models\OrdersArticle;
use App\Models\OrdersType;
use App\Models\SubAgency;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function show()
    {
        $id_user = Auth::id();
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $formattedDate = $date->format('Y-m-d');
        $orders = Order::join('districts', 'orders.idDistrict', '=', 'districts.idDistrict')
            ->where('idUser', $id_user)
            ->whereDate('date_delivery', $formattedDate)
            ->get();
        $articles = OrdersArticle::join('articles', 'orders_article.idArticle', '=', 'articles.idArticle')->get();
        $order_type = OrdersType::all();

        return view('roles.cliente1.pages.orders', compact('orders', 'articles', 'formattedDate', 'order_type'));
    }

    public function show_admin()
    {
        $orders = Order::join('districts', 'orders.idDistrict', '=', 'districts.idDistrict')
            ->join('users', 'orders.idUser', '=', 'users.id')
            ->orderBy('idOrders', 'desc')
            ->select('orders.code', 'orders.idOrders', 'users.company_name', 'orders.date_delivery', 'orders.state', 'orders.amount', 'orders.idOrdersType')
            ->get();
        $order_type = OrdersType::all();
        return view('roles.admin.pages.orders', compact('orders', 'order_type'));
    }

    public function orders_form()
    {

        $methods = MethodPayment::all();
        $districts = District::all();
        $agencies = Agency::all();
        $cities = City::all();
        $id_user = Auth::id();
        $types = OrdersType::all();
        $articles = Article::where('idUser', $id_user)->get();
        return view('roles.cliente1.pages.orders_form', compact('methods', 'districts', 'articles', 'types', 'agencies', 'cities'));
    }

    public function search_select_city(Request $request)
    {
        $selectedCity = $request->input('selectedCity');
        // Realizar la consulta a la base de datos para obtener los barrios correspondientes al valor seleccionado
        $districts = District::where('idCity', $selectedCity)
            ->get(['idDistrict', 'district', 'type']);

        return response()->json($districts);
    }
    public function orders_store(Request $request)
    {
        try {
            // Validar los atributos del pedido
            $attributes = $request->validate([
                'idOrdersType' => 'required',
                'name' => 'required',
                'cellphone' => 'required',
                'date_order' => 'required',
                'date_delivery' => 'nullable',
                'address' => 'nullable',
                'district' => 'nullable',
                'reference' => 'nullable',
                'amount' => 'nullable',
                'method' => 'nullable',
                'article' => 'required|array',
            ]);

            $id_user = Auth::id();
            $dni = $request->input('dni');
            $email = $request->input('email');
            $observation = $request->input('observation');

            $idArticles = $request->input('id');
            $article = $request->input('article');
            $quantityArticle = $request->input('quantityArticle');

            // Crear y guardar el pedido
            $order = new Order;
            $order->name = $attributes['name'];
            $attributes['cellphone'] = '51' . $attributes['cellphone'];
            $order->cellphone = $attributes['cellphone'];
            $order->dni = !empty($dni) ? $dni : null;
            $order->email = !empty($email) ? $email : null;
            $order->observation = !empty($observation) ? $observation : null;
            $order->address = !empty($attributes['address']) ? $attributes['address'] : null;
            if ($attributes['idOrdersType'] == 1) {
                $order->idDistrict = 50;
            } else {
                $order->idDistrict = !empty($attributes['district']) ? $attributes['district'] : null;
            }
            $order->date_delivery = !empty($attributes['date_delivery']) ? $attributes['date_delivery'] : $attributes['date_order'];
            $order->idMethod = !empty($attributes['method']) ? $attributes['method'] : null;
            $order->amount = !empty($attributes['amount']) ? $attributes['amount'] : null;
            $order->reference = !empty($attributes['reference']) ? $attributes['reference'] : null;
            $order->date_order = $attributes['date_order'];
            $order->state = 2;
            $order->idUser = $id_user;
            $order->idOrdersType = $attributes['idOrdersType'];
            $newCode = $this->generateCode();
            $order->code = $newCode;
            $order->save();
            $idOrder = $order->idOrders;

            foreach ($idArticles as $index => $idArticle) {
                $orderDetail = OrdersArticle::create([
                    'idArticle' => $idArticle,
                    'quantity' => isset($quantityArticle[$index]) ? json_decode($quantityArticle[$index]) : null,
                    'idOrders' => $idOrder,
                ]);
            }

            return redirect()->back()->with('success', 'Pedido enviado de manera exitosa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al enviar el pedido: ');
        }
    }

    public function generateCode()
    {
        // Obtener el último código generado
        $lastCode = Order::orderBy('idOrders', 'desc')->value('code');
        $lastNumber = intval(substr($lastCode, 2));
        $newNumber = $lastNumber + 1;
        $formattedNumber = sprintf('%05d', $newNumber);

        $newCode = 'P-' . $formattedNumber;

        return $newCode;
    }

    public function order_detail(Request $request)
    {
        $idOrders = $request->input('id');
        $order = Order::join('districts', 'orders.idDistrict', '=', 'districts.idDistrict')
            ->where('orders.idOrders', $idOrders)->first();
        $articles = OrdersArticle::join('articles', 'orders_article.idArticle', '=', 'articles.idArticle')
            ->where('orders_article.idOrders', $idOrders)->get();
        $orders_type = OrdersType::all();

        return view('roles.cliente1.pages.order_detail', compact('order', 'articles', 'orders_type'));
    }

    public function order_search(Request $request)
    {
        $date = $request->input('date');

        $id_user = Auth::id();
        $orders = Order::join('districts', 'orders.idDistrict', '=', 'districts.idDistrict')
            ->where('idUser', $id_user)
            ->whereDate('date_delivery', $date)
            ->get();
        $articles = OrdersArticle::join('articles', 'orders_article.idArticle', '=', 'articles.idArticle')->get();

        return view('roles.cliente1.pages.order_search', compact('orders', 'articles', 'date'));
    }

    public function show_orders_history()
    {
        $id_user = Auth::id();
        $orders = Order::where('idUser', $id_user)
            ->orderBy('idOrders', 'desc')
            ->get();
        $articles = OrdersArticle::join('articles', 'orders_article.idArticle', '=', 'articles.idArticle')->get();
        $order_type = OrdersType::all();

        return view('roles.cliente1.pages.orders_history', compact('orders', 'articles', 'order_type'));
    }

    public function assign_delivery(Request $request)
    {
        try {
            $idOrder = $request->input('idOrders');
            $idDelivery = $request->input('idDelivery');

            $order = Order::find($idOrder);
            $order->idDelivery = $idDelivery;
            $order->save();

            return redirect()->back()->with('success', 'Delivery asignado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al delivery ');
        }
    }

    public function show_orders_today()
    {
        date_default_timezone_set('America/Lima');
        $date = Carbon::now();
        $formattedDate = $date->format('Y-m-d');

        // Realizar la consulta utilizando la fecha actual en Perú
        $orders = Order::join('districts', 'orders.idDistrict', '=', 'districts.idDistrict')
            ->where('date_delivery', $formattedDate)
            ->get();
        $users = User::all();
        $articles = OrdersArticle::join('articles', 'orders_article.idArticle', '=', 'articles.idArticle')->get();
        $order_type = OrdersType::all();

        return view('roles.almacenero.pages.orders_today', compact('orders', 'articles', 'formattedDate', 'users', 'order_type'));
    }

    public function update_order_state(Request $request)
    {
        try {
            $idOrder = $request->input('id');

            $order = Order::find($idOrder);
            $order->state = 1;
            $order->save();

            return redirect()->back()->with('success', 'Estado de pedido actualizado éxitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al actualizar el estado.');
        }
    }
}
