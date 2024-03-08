@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])




@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Pedidos General'])
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <div class="container-fluid">
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4 class="p-2"><b>LISTADO DE PEDIDOS GENERAL</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-orders" id="tableOrder">
                        <thead>
                            <th colspan="6" class="text-uppercase text-xxs font-weight-bolder opacity-9"></th>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Codigo de pedido</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Cliente</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Fecha de entrega</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Estado de entrega</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Monto de recaudación</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tipo de pedido</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Más información</th>
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
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $item->company_name }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ date('d/m/Y', strtotime($item->date_delivery)) }}
                                        </p>
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
                                        @foreach ($order_type as $type)
                                            @if ($type->idOrdersType == $item->idOrdersType)
                                                <span class="badge badge-lg bg-dark">{{ $type->type }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">
                                        <form action="{{ route('order.detail') }}" method="POST">
                                            @csrf
                                            <input hidden type="number" name="id" value="{{ $item->idOrders }}">
                                            <button class="btn btn-outline-primary btn-sm mb-0" type="submit">Ver
                                                más</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('roles.cliente1.components.modal_delivery_detail')
        @include('roles.cliente1.components.modal_fulfillment_detail')
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
    <!-- Scripts de jQuery y DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/cliente1/orders.js') }}"></script>
