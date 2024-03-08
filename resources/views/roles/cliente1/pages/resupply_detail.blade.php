@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalle de reabastecimiento'])
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card h-100 p-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0 text-uppercase"><strong>DATOS</strong></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0 p-3">
                        <div class="row">
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fas fa-calendar opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">Fecha de envío</h6>

                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ date('d/m/Y', strtotime($resupply->date)) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fas fa-building opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">Agencia</h6>

                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0 text-uppercase">{{ $resupply->agency }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-0 p-3">
                            <div class="card">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0 text-uppercase">Comentarios</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div
                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                        <h6 class="mb-0 text-uppercase">{{ $resupply->comments }}</h6>
                                        <i class="fas fa-comments ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Comentarios"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-0 p-3">
                            <div class="card">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0 text-uppercase">ESTADO</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div
                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                        <h6 class="mb-0 text-uppercase">
                                            @if ($resupply->state == 1)
                                                <span class="badge badge-lg bg-gradient-success">Recibido</span>
                                            @else
                                                <span class="badge badge-lg bg-gradient-danger">No Recibido</span>
                                            @endif
                                        </h6>
                                        @if ($resupply->state == 1)
                                            <i class="fas fa-check ms-auto text-dark cursor-pointer"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Recibido"></i>
                                        @else
                                            <i class="fas fa-times ms-auto text-dark cursor-pointer"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="No recibido"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0 text-uppercase"><strong>Documento</strong></h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-primary mb-0"
                                    href="{{ asset('storage') . '/' . $resupply->document }}" target="_blank">Ver
                                    completo</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @php
                            $documentPath = asset('storage/' . $resupply->document);
                            $extension = pathinfo($resupply->document, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <!-- Si es una imagen -->
                            <img src="{{ $documentPath }}" class="img-fluid" alt="Vista previa">
                        @elseif ($extension === 'pdf')
                            <!-- Si es un PDF -->
                            <iframe src="{{ $documentPath }}" frameborder="0" width="100%" height="500px"></iframe>
                        @else
                            <!-- Si no es una imagen ni un PDF, puedes manejar otros tipos de archivos o simplemente mostrar un mensaje de error -->
                            <p>No se puede mostrar una vista previa para este tipo de archivo.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="text-uppercase"><strong>DETALLE DE ARTICULOS</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Articulo</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Total Articulo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Cajas</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Alto</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ancho</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Profundidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="/img/articles.png" class="avatar avatar-sm me-3"
                                                            alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->description }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->quantity_article }}
                                                    (unidad)
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="/img/boxes.png" class="avatar avatar-sm me-3"
                                                            alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->quantity_box }} (unidad)</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $item->height }} cm</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $item->width }} cm</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $item->depth }} cm</span>
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
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
