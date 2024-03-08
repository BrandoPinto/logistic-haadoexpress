<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Reabastecimientos no recibidos</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $resupply = \App\Models\Resupply::where('state', 2)->count();
                                @endphp
                                {{ $resupply }}
                            </h5>
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder"></span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="fas fa-truck text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pedidos no entregados</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $orders = \App\Models\Order::where('state', 2)->count();
                                @endphp
                                {{ $orders }}
                            </h5>
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder"></span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="fas fa-boxes text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Total general de articulos</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $total_articles = \App\Models\Article::all()->count();
                                @endphp
                                {{ $total_articles }}
                            </h5>
                            <p class="mb-0">
                                <span class="text-danger text-sm font-weight-bolder"></span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="fas fa-wallet text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">PEDIDOS CONTRA ENTREGA SIN DELIVERY ASIGNADO</h6>
                <p class="text-sm mb-0">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <span class="font-weight-bold">Recuerde siempre asignar un delivery para la entrega.</span>
                </p>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive p-0">
                    @php
                        $orders = \App\Models\Order::join('districts', 'orders.idDistrict', '=', 'districts.idDistrict')
                            ->where('state', 2)
                            ->where('idOrdersType', 2)
                            ->whereNull('idDelivery')
                            ->orderByDesc('date_delivery')
                            ->get();
                    @endphp
                    <table class="table align-items-center mb-0 table-dashboard" id="tableDashboard">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Codigo de pedido</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Estado de entrega</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Monto de recaudación</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Más información</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Cambiar estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="/img/orders_list.png" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->code }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($item->state == 1)
                                            <span class="badge badge-lg bg-gradient-success">Recibido</span>
                                        @else
                                            <span class="badge badge-lg bg-gradient-danger">No Recibido</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-dark text-xs font-weight-bold"><strong>S/{{ $item->amount }}</strong></span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <form action="{{ route('order.detail') }}" method="POST">
                                            @csrf
                                            <input hidden type="number" name="id" value="{{ $item->idOrders }}">
                                            <button class="btn btn-outline-primary btn-sm mb-0" type="submit">Ver
                                                más</button>
                                        </form>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button class="btn btn-primary btn-sm mb-0 btn-assign-delivery"
                                            data-id="{{ $item->idOrders }}" data-bs-toggle="modal"
                                            data-bs-target="#modal-assign-delivery">Asignar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">REABASTECIMIENTO SIN RECIBIR</h6>
                <p class="text-sm mb-0">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <span class="font-weight-bold">Recuerde siempre actualizar el estado.</span>
                </p>
            </div>
            @php
                $resupplies = \App\Models\Resupply::join('users', 'resupply.idUser', '=', 'users.id')
                    ->where('resupply.state', 2)
                    ->get();
                $deliveries = \App\Models\User::where('id_rol', 3)->get();
            @endphp
            <div class="card-body p-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-dashboard">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Cliente</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Fecha de envío</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Agencia</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Estado</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Más información</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resupplies as $item)
                                <tr>
                                    <td class="text-secondary text-xs font-weight-bold text-uppercase">
                                        {{ $item->company_name }}</td>
                                    <td class="text-secondary text-xs font-weight-bold text-uppercase">
                                        {{ date('d/m/Y', strtotime($item->date)) }}</td>
                                    <td class="text-secondary text-xs font-weight-bold text-uppercase">
                                        {{ $item->agency }}</td>
                                    <td><span class="badge badge-lg bg-gradient-danger">No Recibido</span></td>
                                    <td>
                                        <form action="{{ route('resupply.detail') }}" method="POST">
                                            @csrf
                                            <input hidden type="number" name="id"
                                                value="{{ $item->idResupply }}">
                                            <button class="btn btn-outline-primary btn-sm mb-0" type="submit">Ver
                                                más</button>
                                        </form>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm mb-0 btn-resupply-state"
                                            data-bs-toggle="modal" data-bs-target="#modal-state-resupply"
                                            data-id="{{ $item->idResupply }}">Estado <i
                                                class="fas fa-toggle-on"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    {{-- 
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <h6 class="text-uppercase">Clientes que no recibieron notificación por WhatsApp</h6>
                <p class="text-sm mb-0">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <span class="font-weight-bold">Recuerde enviar un mensaje de WhatsApp la cliente por su
                        pedido.</span>
                </p>
            </div>
            <div class="card-body p-3">
               
                <div class="table-responsive p-0">
                    <table class="table align-items-center table-dashboard">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Cliente</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Celular</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Ciudad</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     --}}
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <h6 class="text-uppercase">Articulos que requieren asignar tipo de fulfillment</h6>
                <p class="text-sm mb-0">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <span class="font-weight-bold">Recuerde asignar para poder sumar el monto según el tipo.</span>
                </p>
            </div>
            @php
                $articles = \App\Models\Article::join('users', 'articles.idUser', '=', 'users.id')
                    ->where('fulfillment_state', 1)
                    ->whereNull('idFulfillment')
                    ->get();
            @endphp
            <div class="card-body p-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center table-dashboard">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Cliente</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Articulo</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $item)
                                <tr>
                                    <td class="text-secondary text-xs font-weight-bold text-uppercase">
                                        {{ $item->company_name }}</td>
                                    <td class="text-secondary text-xs font-weight-bold text-uppercase">
                                        {{ $item->description }}</td>
                                    <td><button class="btn btn-primary btn-sm btn-assign-fulfillment"
                                            data-id="{{ $item->idArticle }}" data-bs-toggle="modal"
                                            data-bs-target="#modal-assign-fulfillment">Asignar</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">

    </div>
    @include('roles.almacenero.components.modal_assign_delivery')
    @include('roles.almacenero.components.modal_state_resupply')
    @include('roles.almacenero.components.modal_assign_fulfillment')
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/almacenero/dashboard.js') }}"></script>
