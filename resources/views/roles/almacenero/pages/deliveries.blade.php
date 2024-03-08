@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Listado de Deliveries'])
    <div class="container-fluid">
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4 class="p-2"><b>LISTADO DE DELIVERIES</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table align-items-center mb-0" id="clientes">
                        <thead class="text-white">
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    #</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Nombre y Apellido</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    DNI</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Email</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Celular</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr class="text-center">
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="text-uppercase text-secondary text-xs font-weight-bold">{{ $item->firstname }} {{ $item->lastname }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->dni }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->email }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->celphone }}</span>
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
