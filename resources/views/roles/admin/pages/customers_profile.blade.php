@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')

@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Perfil de Usuario'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" class="w-100 border-radius-lg shadow-sm">
                        @else
                            <img src="/img/profile.png" class="w-100 border-radius-lg shadow-sm">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1 text-uppercase">
                            @php
                                $name_lastname = '';
                                if ($user->id_rol == 1 || $user->id_rol == 4 || $user->id_rol == 5 || $user->id_rol == 6) {
                                    $name_lastname = $user->company_name;
                                } elseif ($user->id_rol == 2 || $user->id_rol == 3) {
                                    $name_lastname = $user->firstname . ' ' . $user->lastname;
                                }
                            @endphp
                            {{ $name_lastname }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            @php
                                $name = '';
                                if ($user->id_rol == 1) {
                                    $name = 'Administrador';
                                } elseif ($user->id_rol == 2) {
                                    $name = 'Almacenero';
                                } elseif ($user->id_rol == 3) {
                                    $name = 'Delivery';
                                } else {
                                    $name = 'Cliente';
                                }
                            @endphp
                            {{ $name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('customer.profile.update') }}
                        enctype="multipart/form-data">
                        @csrf
                        <input hidden type="number" name="id_user" value="{{ $user->id }}">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Editar Perfil</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Guardar</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Información de usuario</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Password</label>
                                        <input class="form-control" type="text" name="password" value="">
                                        <small>Por seguridad no podemos mostrar la contraseña, si desea puede colocar una
                                            nueva.</small>
                                    </div>
                                </div>
                            </div>
                            @if ($user->id_rol == 1 || $user->id_rol == 4 || $user->id_rol == 5 || $user->id_rol == 6)
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Información de empresa</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nombre de
                                                empresa</label>
                                            <input class="form-control" type="text" name="company_name"
                                                value="{{ $user->company_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Ciudad de
                                                empresa</label>
                                            <input class="form-control" type="text" name="city"
                                                value="{{ $user->city }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Acerde de</label>
                                                <input class="form-control" type="text" name="about"
                                                    value="{{ $user->about }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Información de contacto</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nombres</label>
                                        <input class="form-control" type="text" name="firstname"
                                            value="{{ $user->firstname }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Apellido</label>
                                        <input class="form-control" type="text" name="lastname"
                                            value="{{ $user->lastname }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">DNI</label>
                                        <input class="form-control" type="number" name="dni"
                                            value="{{ $user->dni }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Celular</label>
                                        <input class="form-control" type="number" name="celphone"
                                            value="{{ $user->celphone }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dirección</label>
                                        <input class="form-control" type="text" name="address"
                                            value="{{ $user->address }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-subemail">Nueva
                            sub cuenta <i class="fas fa-plus-square"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-2">
                            <table class="table align-items-center mb-0 table-users">
                                <thead class="text-white">
                                    <tr class="bg-primary text-white">
                                        <th class="text-uppercase text-center text-xxs font-weight-bolder" colspan="5">
                                            LISTADO DE SUBCUENTAS</th>
                                    </tr>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Contraseña</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tipo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones</th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $item)
                                        <tr>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->email }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->password }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if ($item->type_email == 1)
                                                        Principal
                                                    @else
                                                        Sub cuenta
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <button @if ($item->type_email == 1) disabled @endif
                                                        class="btn btn-success btn-xs"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button @if ($item->type_email == 1) disabled @endif data-id="{{ $item->idEmail }}" class="btn btn-danger btn-xs deleteEmail"><i class="fas fa-trash"></i></button>

                                                </span>
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
        @include('roles.admin.components.modal_new_subemail')
        @include('layouts.footers.auth.footer')
    </div>
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/admin/customers.js') }}"></script>
    <script>
        //TOKEN CSRF
        const csrfToken = "{{ csrf_token() }}";
    </script>

