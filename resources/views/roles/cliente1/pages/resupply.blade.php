@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Reabastecimiento'])
    <div class="container-fluid">
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4 class="p-2"><b>LISTADO DE ENVIOS PARA REABASTECIMIENTO</b></h4>
                <div class="ml-auto">
                    <a class="btn btn-primary" href="{{ route('resupply.form') }}"">Nuevo Reabastecimiento <i
                            class="fas fa-plus-square"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table align-items-center mb-0" id="clientes">
                        <thead class="text-white">
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    #</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Fecha de envío</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Agencia</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Detalle</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resupplies as $item)
                                <tr class="text-center">
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ date('d/m/Y', strtotime($item->date)) }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->agency }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('resupply.detail') }}" method="POST">
                                            @csrf
                                            <input hidden type="number" name="id" value="{{ $item->idResupply }}">
                                            <button class="btn btn-outline-dark btn-sm mb-0" type="submit">Ver más</button>
                                        </form>
                                    </td>
                                    <td class="align-middle">
                                        @if ($item->state == 1)
                                            <span class="badge badge-sm bg-gradient-success">Recibido</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-danger">Sin recibir</span>
                                        @endif
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
    <script src="{{ asset('js/cliente1/resupply.js') }}"></script>
    <script>
        //TOKEN CSRF
        const csrfToken = "{{ csrf_token() }}";
    </script>
