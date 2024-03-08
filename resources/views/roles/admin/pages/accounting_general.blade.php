@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Contabilidad General'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('search.accounting') }}" method="POST">
                            @csrf
                            <div class="row align-items-center justify-content-between">
                                <div class="col-md-8">
                                    <label>Mes <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <select required class="form-control" name="month">
                                            <option hidden>Seleccione mes</option>
                                            @foreach (['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'] as $index => $month)
                                                <option value="{{ $index + 1 }}">{{ ucfirst($month) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Año <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required type="number" class="form-control" name="year"
                                            value="{{ $currentYear }}">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-4">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary">
                        <h5 class="text-uppercase text-white">Mi contabilidad para el mes de {{ $monthName }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive p-0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Categoría</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Monto</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-dark text-sm font-weight-bold">Total ingreso por
                                                            delivery/agencia :
                                                        </td>
                                                        <td class="text-center text-dark text-sm font-weight-bold">
                                                            @php
                                                                $totalTariff = 0;
                                                            @endphp
                                                            @foreach ($orders as $order)
                                                                @foreach ($tariffs as $tariff)
                                                                    @if ($order->state == 1)
                                                                        @if ($order->idDistrict == $tariff->idDistrict)
                                                                            @php
                                                                                $totalTariff += $tariff->tariff;
                                                                            @endphp
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                            S/{{ $totalTariff }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark text-sm font-weight-bold">Total ingreso por
                                                            fulfillment: </td>
                                                        <td class="text-center text-dark text-sm font-weight-bold">
                                                            @php
                                                                $totalFulfillment = 0;
                                                            @endphp
                                                            @foreach ($orders as $order)
                                                                @foreach ($articles as $article)
                                                                    @if ($order->state == 1)
                                                                        @if ($order->idArticle == $article->idArticle)
                                                                            @php
                                                                                $totalFulfillment += $article->amount;
                                                                            @endphp
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                            S/{{ $totalFulfillment }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive p-0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Categoría</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $ordersDelivered = 0;
                                                        $ordersUndelivered = 0;
                                                    @endphp
                                                    @foreach ($orders as $order)
                                                        @if ($order->state == 1)
                                                            @php
                                                                $ordersDelivered++;
                                                            @endphp
                                                        @elseif($order->state == 2)
                                                            @php
                                                                $ordersUndelivered++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td class="text-dark text-sm font-weight-bold">Total pedidos
                                                            entregados:
                                                        </td>
                                                        <td class="text-center text-dark text-sm font-weight-bold">
                                                            {{ $ordersDelivered }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark text-sm font-weight-bold">Total pedidos no
                                                            entregados: </td>
                                                        <td class="text-center text-dark text-sm font-weight-bold">
                                                            {{ $ordersUndelivered }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary">
                        <h5 class="text-uppercase text-white">Contabilidad de clientes para el mes de {{ $monthName }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive p-0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Categoría</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Monto</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $totalDelivery = 0;
                                                        $totalAgency = 0;
                                                    @endphp
                                                    @foreach ($orders as $order)
                                                        @if ($order->idOrdersType == 1)
                                                            @php
                                                                $totalAgency += $order->amount;
                                                            @endphp
                                                        @elseif($order->state == 2)
                                                            @php
                                                                $totalDelivery += $order->amount;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td class="text-dark text-sm font-weight-bold">Total ingreso por
                                                            pedido delivery:
                                                        </td>
                                                        <td class="text-center text-dark text-sm font-weight-bold">
                                                            S/{{ $totalDelivery }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark text-sm font-weight-bold">Total ingreso por
                                                            pedido de agencia: </td>
                                                        <td class="text-center text-dark text-sm font-weight-bold">
                                                            S/{{ $totalAgency }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
    @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
