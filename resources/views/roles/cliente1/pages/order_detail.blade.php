@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalle de pedido'])
    <div class="container-fluid">
        <div class="row mt-6">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xl-6 mb-xl-0 mb-4">
                        <div class="card bg-gradient-primary shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body position-relative z-index-1 p-3">
                                    <i class="fas fa-user text-white p-2"></i>
                                    <h5 class="text-white mt-4 mb-5 pb-2">
                                        <strong>DATOS DE CLIENTE</strong>
                                    </h5>
                                    <di v class="d-flex">
                                        <div class="d-flex">
                                            <div class="me-4">
                                                <p class="text-white text-sm opacity-8 mb-0">Nombres:</p>
                                                <h6 class="text-white mb-0 text-uppercase">{{ $order->name }}</h6>
                                            </div>
                                            <div class="me-4">
                                                <p class="text-white text-sm opacity-8 mb-0">Celular</p>
                                                <h6 class="text-white mb-0">{{ $order->cellphone }}</h6>
                                            </div>
                                            <div class="me-4">
                                                <p class="text-white text-sm opacity-8 mb-0">DNI</p>
                                                <h6 class="text-white mb-0">{{ $order->dni }}</h6>
                                            </div>
                                        </div>
                                    </di>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4 mt-md-0 mt-4">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fas fa-barcode opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">Código Pedido</h6>
                                        <span class="text-xs"><i class="fas fa-barcode"></i></span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $order->code }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-md-0 mt-4">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fas fa-calendar opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">Fecha Pedido</h6>
                                        <span class="text-xs"><i class="fas fa-calendar"></i></span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ date('d/m/Y', strtotime($order->date_order)) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-md-0 mt-4">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fas fa-motorcycle opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">Fecha entrega</h6>
                                        <span class="text-xs"><i class="fas fa-motorcycle"></i></span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ date('d/m/Y', strtotime($order->date_delivery)) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-lg-0 mb-4">
                        <div class="card mt-4">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0 text-uppercase">Dirección de cliente</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-6 mb-md-0 mb-4">
                                        <div
                                            class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                            <h6 class="mb-0 text-uppercase">{{ $order->address }}</h6>
                                            <i class="fas fa-home ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Dirección"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                            <h6 class="mb-0 text-uppercase">{{ $order->district }}</h6>
                                            <i class="fas fa-map-pin ms-auto text-dark cursor-pointer"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Distrito"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0 text-uppercase">Articulos en pedido</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <ul class="list-group">
                            @foreach ($articles as $item)
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $item->description }}</h6>
                                        <span class="text-xs">Id Articulo: {{ $item->idArticle }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        <i class="fas fa-boxes text-lg me-1"></i>
                                    </div>
                                </li>
                            @endforeach
                            <hr>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"><strong>TOTAL:</strong></h6>
                                </div>
                                <div class="d-flex align-items-center text-sm">
                                    S/{{ $order->amount }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0 text-uppercase">Observaciones</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                            <h6 class="mb-0 text-uppercase">{{ $order->observation }}</h6>
                            <i class="fas fa-comments ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Observaciones"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0 text-uppercase">Tipo de Pedido</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                            @foreach ($orders_type as $ordertype)
                            @if ($order->idOrdersType == $ordertype->idOrdersType)
                            <h6 class="mb-0 text-uppercase">{{ $ordertype->type }}</h6>
                            @endif
                            @endforeach
                            <i class="fas fa-truck ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Tipo de pedido"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0 text-uppercase">Estado de pedido</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-6 mb-md-0 mb-4">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0 text-uppercase">
                                        @if ($order->state == 1)
                                            <span class="badge badge-lg bg-gradient-success">Entregado</span>
                                        @else
                                            <span class="badge badge-lg bg-gradient-danger">No Entregado</span>
                                        @endif
                                    </h6>
                                    @if ($order->state == 1)
                                        <i class="fas fa-check ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Entregado"></i>
                                    @else
                                        <i class="fas fa-times ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="No entregado"></i>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    @if ($order->real_date)
                                        <h6 class="mb-0 text-uppercase">Fecha real de entrega:
                                            {{ date('d/m/Y', strtotime($order->real_date)) }}</h6>
                                    @endif
                                    <i class="fas fa-calendar ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Fecha real de entrega"></i>
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
