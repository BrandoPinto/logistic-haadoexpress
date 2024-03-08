@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Blog'])
    <div class="container-fluid">
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4 class="p-2"><b>Blog</b></h4>
                <div class="ml-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-customer">Nuevo imagen <i
                            class="fas fa-plus-square"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($blog as $item)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <form action="{{ route('update.image') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="itemId" value="{{ $item->idBlog }}">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                                name="state" value="{{ $item->state }}"
                                                @if ($item->state == 1) checked @endif
                                                onchange="this.form.submit()">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Activar</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <img src="{{ asset('storage') . '/' . $item->image }}" class="img-fluid"
                                        style="max-width: 100%; height: auto;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('roles.admin.components.modal_new_blog')
        @include('layouts.footers.auth.footer')
    </div>
@endsection
