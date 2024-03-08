@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Pedidos de Usuario ' . $user->company_name])
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xl-8 mb-xl-0 mb-4">
                        <div class="card bg-gradient-primary shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl">
                                <span class="mask bg-gradient-primary"></span>
                                <div class="card-body position-relative z-index-1 p-3">
                                    <div class="d-flex">
                                        <i class="fas fa-user text-white mt-1 p-1"></i>
                                        <h5 class="text-white mb-1 pb-2 text-uppercase">
                                            <strong>DATOS DE USUARIO {{ $user->company_name }}</strong>
                                        </h5>
                                    </div>
                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <div class="me-4">
                                                <p class="text-white text-sm opacity-8 mb-0">Nombres:</p>
                                                <h6 class="text-white mb-0 text-uppercase">{{ $user->company_name }}</h6>
                                            </div>
                                            <div class="me-4">
                                                <p class="text-white text-sm opacity-8 mb-0">Celular</p>
                                                <h6 class="text-white mb-0">{{ $user->cellphone }}</h6>
                                            </div>
                                            <div class="me-4">
                                                <p class="text-white text-sm opacity-8 mb-0">Email</p>
                                                <h6 class="text-white mb-0">{{ $user->email }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-gradient-white shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl">
                                <span class=""></span>
                                <div class="card-body position-relative z-index-1 p-3">
                                    <div class="d-flex">
                                        <i class="fas fa-comment-dollar text-dark mt-1 p-1"></i>
                                        <h5 class="text-dark mb-1 pb-2 text-uppercase">
                                            <strong>Total Generado por usuario</strong>
                                        </h5>
                                    </div>
                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <div class="me-4">
                                                <p class="text-dark text-sm opacity-8 mb-0">Total:</p>
                                                <h6 class="text-dark mb-0 text-uppercase">S/{{ $total_customer }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header pb-0">
                <h4><b>Listado de pedidos de cliente</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-orders" id="tableOrder">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Codigo de pedido</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Fecha de entrega</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Estado de entrega</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tipo de pedido</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Monto de recaudación</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Monto total de descuento</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Más información de pedido</th>
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
                                        @foreach ($order_type as $type)
                                            @if ($type->idOrdersType == $item->idOrdersType)
                                                <span class="badge badge-lg bg-dark">{{ $type->type }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-dark text-xs font-weight-bold"><strong>S/{{ $item->amount }}</strong></span>
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                            $accounting_controller = new \App\Http\Controllers\Admin\AccountingController();
                                            $total_discount_tariff = $accounting_controller->total_discount_tariff(
                                                $item->idOrders,
                                            );
                                            $total_discount_fulfillment = $accounting_controller->total_discount_fulfillment(
                                                $item->idOrders,
                                            );
                                            $total_discount = $total_discount_tariff + $total_discount_fulfillment;
                                        @endphp
                                        <span
                                            class="text-dark text-xs font-weight-bold"><strong>S/{{ $total_discount }}</strong></span>
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
    </div>
    @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
