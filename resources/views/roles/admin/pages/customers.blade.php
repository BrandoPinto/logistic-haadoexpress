@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Clientes'])
    <div class="container-fluid">
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4 class="p-2"><b>LISTADO DE USUARIOS</b></h4>
                <div class="ml-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-customer">Nuevo usuario
                        <i class="fas fa-plus-square"></i></button>
                </div>
            </div>
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#customers"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Clientes</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#warehousemen"
                            type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Almaceneros</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#delivery"
                            type="button" role="tab" aria-controls="nav-contact"
                            aria-selected="false">Delivery</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#admins"
                            type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Admins</button>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="customers" role="tabpanel" aria-labelledby="nav-home-tab">
                        @include('roles.admin.components.table_list_customer')
                    </div>
                    <div class="tab-pane fade" id="warehousemen" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @include('roles.admin.components.table_list_warehousemen')
                    </div>
                    <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="nav-contact-tab">
                        @include('roles.admin.components.table_list_delivery')
                    </div>
                    <div class="tab-pane fade" id="admins" role="tabpanel" aria-labelledby="nav-contact-tab">
                        @include('roles.admin.components.table_list_admin')
                    </div>
                </div>


  
            </div>
        </div>
        @include('roles.admin.components.modal_new_customer')
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
    <!-- Scripts de jQuery y DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/admin/customers.js') }}"></script>
    <script>
        //TOKEN CSRF
        const csrfToken = "{{ csrf_token() }}";
    </script>
