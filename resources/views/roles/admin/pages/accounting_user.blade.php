@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])




@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Contabilidad por clientes'])
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <div class="container-fluid">
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4><b>Datos contables generales de clientes</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-orders" id="tableOrder">
                        <thead>
                            <tr>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    #</th>
                                <th
                                    class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Cliente</th>
                                <th
                                    class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Cantidad de pedidos entregados</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total por pedidos entregados</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total descuentos por entrega</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total descuentos por fulfillment</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Más información</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $accounting_controller = new \App\Http\Controllers\Admin\AccountingController();
                                $order_cantity = 0;
                                $total_amount = 0;
                            @endphp
                            @foreach ($users as $item)
                                <tr>
                                    <td class="align-middle text-center">
                                        <p class="text-dark text-xs font-weight-bold">
                                            {{ $loop->iteration }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-dark text-xs font-weight-bold">
                                            {{ $item->company_name }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @foreach ($orders as $order)
                                            @if ($item->id == $order->idUser)
                                                @if ($order->state == 1)
                                                    @php
                                                        $order_cantity++;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        <p class="text-dark text-xs font-weight-bold">
                                            {{ $order_cantity }} pedido (s).
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @foreach ($orders as $order)
                                            @if ($item->id == $order->idUser)
                                                @if ($order->state == 1)
                                                    @php
                                                        $total_amount += $order->amount;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        <p class="text-dark text-xs font-weight-bold">
                                            S/{{ $total_amount }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @foreach ($orders as $order)
                                            @if ($item->id == $order->idUser)
                                                @if ($order->state == 1)
                                                    <p class="text-dark text-xs font-weight-bold">
                                                        @php
                                                            $total_discount_tariff = $accounting_controller->total_discount_tariff(
                                                                $order->idOrders,
                                                            );
                                                        @endphp
                                                        S/{{ $total_discount_tariff }}
                                                    </p>
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">
                                        @foreach ($orders as $order)
                                            @if ($item->id == $order->idUser)
                                                @if ($order->state == 1)
                                                    <p class="text-dark text-xs font-weight-bold">
                                                        @php
                                                            $total_discount_fulfillment = $accounting_controller->total_discount_fulfillment(
                                                                $order->idOrders,
                                                            );
                                                        @endphp
                                                        S/{{ $total_discount_fulfillment }}
                                                    </p>
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">
                                        <form action="{{ route('accounting.customer.detail') }}" method="POST">
                                            @csrf
                                            <input hidden type="number" name="id" value="{{ $item->id }}">
                                            <button class="btn btn-outline-primary btn-sm mb-0" type="submit">Detallado</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
    <!-- Scripts de jQuery y DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/admin/accounting.js') }}"></script>
