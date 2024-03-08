@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Perfil'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if (Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                class="w-100 border-radius-lg shadow-sm border-white">
                        @else
                            <img src="/img/profile.png" class="w-100 border-radius-lg shadow-sm border-white">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1 text-uppercase">
                            @php
                                $id_rol = auth()->user()->id_rol;
                                $name_lastname = '';
                                if ($id_rol == 1 || $id_rol == 4 || $id_rol == 5 || $id_rol == 6) {
                                    $name_lastname = auth()->user()->company_name;
                                } elseif ($id_rol == 2 || $id_rol == 3) {
                                    $name_lastname = auth()->user()->firstname . ' ' . auth()->user()->lastname;
                                }
                            @endphp
                            {{ $name_lastname }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            @php
                                $id_rol = auth()->user()->id_rol;
                                $name = '';
                                if ($id_rol == 1) {
                                    $name = 'Administrador';
                                } elseif ($id_rol == 2) {
                                    $name = 'Almacenero';
                                } elseif ($id_rol == 3) {
                                    $name = 'Delivery';
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
            <div class="col-md-8">
                <div class="card">
                    <form role="form" method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
                        @csrf
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
                                        <input disabled class="form-control" type="email"
                                            value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                </div>
                            </div>
                            @php
                                $id_rol = auth()->user()->id_rol;
                            @endphp
                            @if ($id_rol == 1 || $id_rol == 4 || $id_rol == 5 || $id_rol == 6)
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Información de empresa</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nombre de
                                                empresa</label>
                                            <input class="form-control" type="text" name="company_name"
                                                value="{{ old('company_name', auth()->user()->company_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Ciudad de
                                                empresa</label>
                                            <input class="form-control" type="text" name="city"
                                                value="{{ old('city', auth()->user()->city) }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Acerde de</label>
                                                <input class="form-control" type="text" name="about"
                                                    value="{{ old('about', auth()->user()->about) }}">
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
                                            value="{{ old('firstname', auth()->user()->firstname) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Apellido</label>
                                        <input class="form-control" type="text" name="lastname"
                                            value="{{ old('lastname', auth()->user()->lastname) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">DNI</label>
                                        <input class="form-control" type="number" name="dni"
                                            value="{{ old('dni', auth()->user()->dni) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Celular</label>
                                        <input class="form-control" type="number" name="celphone"
                                            value="{{ old('celphone', auth()->user()->celphone) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Dirección</label>
                                        <input class="form-control" type="text" name="address"
                                            value="{{ old('address', auth()->user()->address) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{--  
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    @if (Auth::user()->photo)
                                        <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                            class="rounded-circle img-fluid border border-2 border-white">
                                    @else
                                        <img src="/img/profile.png"
                                            class="rounded-circle img-fluid border border-2 border-white">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary" id="btnOpenFile" type="button">Cambiar imagen <i
                                    class="fas fa-camera"></i></button>
                            <form id="formUpload" action="{{ route('customer.profile.update.photo') }}" method="POST"
                                enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input class="form-control" hidden type="number" name="idUser"  value="{{ old('id', auth()->user()->id) }}">
                                <input id="inputFile" type="file" name="photo" accept="image/*">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            --}}
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btnOpenFile').addEventListener('click', function() {
                document.getElementById('inputFile').click();
            });

            document.getElementById('inputFile').addEventListener('change', function() {
                document.getElementById('formUpload').submit();
            });
        });
    </script>
