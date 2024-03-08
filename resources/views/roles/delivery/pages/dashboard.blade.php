<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="row">
    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">MIS PEDIDOS ASIGNADOS PARA HOY</h6>
                <p class="text-sm mb-0">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <span class="font-weight-bold">Recuerde siempre actualizar el estado</span>
                </p>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive p-0">
                    @php
                        use Carbon\Carbon;
                        date_default_timezone_set('America/Lima');
                        $date = Carbon::now();
                        $formattedDate = $date->format('Y-m-d');
                        $id_user = Auth::id();
                        $orders = \App\Models\Order::join('districts', 'orders.idDistrict', '=', 'districts.idDistrict')
                            ->whereDate('date_delivery', $formattedDate)
                            ->where('idDelivery', $id_user)
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
                                            <span class="badge badge-lg bg-gradient-success">Entregado</span>
                                        @else
                                            <span class="badge badge-lg bg-gradient-danger">No Entregado</span>
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
                                        <button @if ($item->state == 1) disabled @endif
                                            class="btn btn-primary btn-sm mb-0 btn-state-order"
                                            data-id="{{ $item->idOrders }}" data-bs-toggle="modal"
                                            data-bs-target="#modal-state-order">Actualizar</button>
                                    </td>
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

    <div class="col-lg-5">

    </div>
    @include('roles.almacenero.components.modal_state_orders')
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/almacenero/dashboard.js') }}"></script>
<script src="{{ asset('js/almacenero/order.js') }}"></script>
