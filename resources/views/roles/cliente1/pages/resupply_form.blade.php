@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Formulario de reabastecimiento'])
    <div class="container-fluid">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="text-uppercase"><b>Nuevo envío para reabastecimiento</b></h4>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ route('resupply.store') }}" enctype="multipart/form-data">
                    @csrf
                    <p class="text-uppercase text-sm">Información de Envío</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Fecha <span
                                        class="text-danger">*</span></label>
                                <input required class="form-control" name="date_resupply" type="date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Agencia <span
                                        class="text-danger">*</span></label>
                                <input required class="form-control text-uppercase" name="agency" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Documento de guía de remisión
                                    <span class="text-danger">*</span>
                                </label>
                                <input required class="form-control" name="document" type="file" accept=".png, .jpg, .jpeg, .pdf">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Información de Paquete/caja y Articulo</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hightInput" class="form-control-label">Altura (cm)
                                    <span class="text-danger">*</span></label>
                                <input class="form-control" id="heightInput"  type="number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="widthInput" class="form-control-label">Ancho (cm)
                                    <span class="text-danger">*</span></label>
                                <input class="form-control" id="widthInput"  type="number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="depthInput" class="form-control-label">Profundidad (cm)
                                    <span class="text-danger">*</span></label>
                                <input class="form-control" id="depthInput" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="quantityBoxInput" class="form-control-label">Cantidad de paquetes/cajas
                                    <span class="text-danger">*</span></label>
                                <input class="form-control" id="quantityBoxInput" type="number">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="articleSelect" class="form-control-label">Articulo
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" id="articleSelect">
                                    <option hidden value="">Seleccione</option>
                                    @foreach ($articles as $item)
                                        <option value="{{ $item->idArticle }}">{{ $item->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="quantityArticleInput" class="form-control-label">Cantidad articulo
                                    <span class="text-danger">*</span></label>
                                <input class="form-control" id="quantityArticleInput" type="number">
                                <small class="text-muted">Total de articulo(s) en toda(s) las caja(s)</small>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-warning" id="addButton">Agregar producto <i class="fas fa-plus-square"></i></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center" colspan="5">Listado de articulos a enviar</th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder d-none">ID</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Articulo</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder d-none">Altura</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder d-none">Ancho</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder d-none">Profundidad</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Cantidad paquetes/cajas</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Cantidad articulo</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaProductos">
                
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group mt-4">
                        <label for="quantityBoxInput" class="form-control-label">Comentarios/observaciones de reabastecimiento</label>
                        <input class="form-control" name="comments" type="text">
                    </div>
                    <button class="btn btn-primary" type="submit">Enviar <i class="fas fa-share-square"></i></button>
                </form>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/cliente1/resupply.js') }}"></script>
    <script>
        //TOKEN CSRF
        const csrfToken = "{{ csrf_token() }}";
    </script>
