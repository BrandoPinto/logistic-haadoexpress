@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Articulos'])
    <div class="container-fluid">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h4 class="p-2"><b>LISTADO DE ARTICULOS</b></h4>
                <div class="ml-auto">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-article">Nuevo articulo <i
                            class="fas fa-plus-square"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table align-items-center mb-0" id="clientes">
                        <thead>
                            <tr class="text-center">
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descripción
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fulfillment
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $item)
                                <tr class="text-center">
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="text-secondary text-xs font-weight-bold text-uppercase">{{ $item->description }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold text-uppercase">
                                            @if ($item->fulfillment_state == 1)
                                                @php $found = false; @endphp
                                                @foreach ($fulfillment as $ful)
                                                    @if ($item->idFulfillment == $ful->idFulfillment)
                                                        Costo: S/{{ $ful->amount }}
                                                        @php $found = true; @endphp
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if (!$found)
                                                <span class="text-danger font-weight-bold">Si requiere <i class="fas fa-exclamation-triangle ms-auto text-dark cursor-pointer"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Aquí le debe aparecer el precio, si no aparece solicítelo al encargado."></i></span>                                                    
                                                @endif
                                            @else
                                                No requiere <i class="fas fa-times"></i>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->stock }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <button id="editArticleButton"
                                            class="btn btn-outline-primary btn-sm mb-0 edit-article-button"
                                            data-id="{{ $item->idArticle }}" data-description="{{ $item->description }}"
                                            type="button">Editar</button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        @include('roles.cliente1.components.modal_new_article')
        @include('roles.cliente1.components.modal_edit_article')
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
    <!-- Scripts de jQuery y DataTables -->
    <script src="{{ asset('js/cliente1/articles.js') }}"></script>
