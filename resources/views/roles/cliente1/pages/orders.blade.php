@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Pedidos'])
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <div class="container-fluid">
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4 class="p-2"><b>LISTADO DE PEDIDOS</b></h4>
                <div class="ml-auto">
                    <a class="btn btn-primary" href="{{ route('orders.history') }}">Historial de pedidos <i
                            class="fas fa-clipboard-list"></i></a>
                    <a class="btn btn-primary" href="{{ route('orders.form') }}">Nuevo Pedido <i
                            class="fas fa-plus-square"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('order.search') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Buscar pedido por
                                    fecha:</label>
                                <input class="form-control text-uppercase btn-outline-dark" type="date" name="date"
                                    id="searchDate">
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <button class="btn btn-primary" type="submit">Buscar <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-orders" id="tableOrder">
                        <thead>
                            <th colspan="6" class="text-uppercase text-xxs font-weight-bolder opacity-9">Pedidos de
                                {{ date('d/m/Y', strtotime($formattedDate)) }}</th>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Codigo de pedido</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Articulos</th>
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
                            @php
                                $totalAmount = 0;
                                $totalDelivery = 0;
                                $totalFulfillment = 0;
                            @endphp

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
                                        <ul>
                                            @foreach ($articles as $article)
                                                @if ($item->idOrders == $article->idOrders)
                                                    <li class="text-xs font-weight-bold mb-0 text-uppercase">
                                                        {{ $article->description }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
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
                                        @php
                                            $totalAmount += $item->amount;
                                            $totalDelivery += $item->tariff;
                                        @endphp
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
                            @php
                                $discounts = $totalDelivery - $totalFulfillment;
                                $grandTotal = $totalAmount - $discounts;
                                $logged_in_email = session('logged_in_email');

                                $email = \App\Models\Email::where('email', $logged_in_email)->first();
                            @endphp
                            @if ($email)
                                @if ($email->type_email == 1)
                                    <tr>
                                        <td colspan="4" class="text-end">Total día:</td>
                                        <td class="text-center">
                                            <span class="font-weight-bold"><strong>S/{{ $totalAmount }}</strong></span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end">Costo delivery ( - )</td>
                                        <td class="text-center">
                                            <span class="font-weight-bold">S/{{ $totalDelivery }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal-delivery-detail">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end">Costo fulfillment ( - )</td>
                                        <td class="text-center">
                                            <span class="font-weight-bold">S/{{ $totalFulfillment }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal-fulfillment-detail">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="bg-primary">
                                        <td colspan="4" class="text-end text-white"><strong>TOTAL GENERAL</strong></td>
                                        <td class="text-center">
                                            <span
                                                class="text-white font-weight-bold"><strong>S/{{ $grandTotal }}</strong></span>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endif
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
