@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Pedidos del día'])
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <div class="container-fluid">
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4 class="p-2"><b>LISTADO DE PEDIDOS DEL DÍA</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="tableOrder">
                        <thead>
                            <th colspan="8" class="text-uppercase text-xxs font-weight-bolder opacity-9">Pedidos de
                                {{ date('d/m/Y', strtotime($formattedDate)) }}</th>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Codigo de pedido</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Cliente</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Articulos</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Fecha de entrega</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Estado de entrega</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tipo de pedido</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Estado</th>
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
                                            @foreach ($users as $user)
                                                @if ($item->idUser == $user->id)
                                                    {{ $user->company_name }}
                                                @endif
                                            @endforeach
                                        </p>
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
                                        @foreach ($order_type as $type)
                                            @if ($type->idOrdersType == $item->idOrdersType)
                                                <span class="badge badge-lg bg-dark">{{ $type->type }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">
                                        <button @if ($item->state == 1) disabled @endif 
                                        class="btn btn-primary btn-sm mb-0 btn-state-order"
                                            data-bs-toggle="modal" data-bs-target="#modal-state-order"
                                            data-id="{{ $item->idOrders }}">Estado  <i
                                                class="fas fa-toggle-on"></i></button>
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
        @include('roles.almacenero.components.modal_state_orders')
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
    <!-- Scripts de jQuery y DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/almacenero/order.js') }}"></script>
