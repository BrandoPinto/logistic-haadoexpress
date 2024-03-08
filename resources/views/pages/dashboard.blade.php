@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        @php
            $role = auth()->user()->id_rol;
        @endphp
        @if ($role == 1)
            @include('roles.admin.pages.dashboard')
        @elseif ($role == 2)
            @include('roles.almacenero.pages.dashboard')
        @elseif ($role == 3)
            @include('roles.delivery.pages.dashboard')
        @elseif ($role == 4)
            @include('roles.cliente1.pages.dashboard')
        @endif
        @include('layouts.footers.auth.footer')
    </div>
@endsection
