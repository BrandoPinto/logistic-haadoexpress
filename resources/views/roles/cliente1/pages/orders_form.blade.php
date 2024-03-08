@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Formulario de pedidos'])
    <div class="container-fluid">
        @include('components.alert')
        <div class="card">
            <div class="card-header">
                <h4 class="text-uppercase"><b>Nuevo pedido</b></h4>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label text-uppercase">Tipo de pedido <span
                                    class="text-danger">*</span></label>
                            <select required class="form-control" name="idOrdersType" id="select-type">
                                <option hidden>Seleccione</option>
                                @foreach ($types as $item)
                                    <option value="{{ $item->idOrdersType }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input hidden class="form-control" type="number" id="input-type-order">
                    <p class="text-uppercase text-sm">Información de cliente</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Nombres y
                                    apellidos
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control text-uppercase" name="name" type="text">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Celular <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">+51</span>
                                    <input required class="form-control" name="cellphone" type="number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-none" id="div-email">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Correo</label>
                                <input class="form-control" name="email" type="email">
                            </div>
                        </div>
                        <div class="col-md-4" id="div-dni">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">DNI</label>
                                <input class="form-control" name="dni" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div-location">                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">CIUDAD <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="city-select">
                                    <option hidden>Seleccione</option>
                                    @foreach ($cities as $item)
                                        <option value="{{ $item->idCity }}">{{ $item->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="div-district">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Distrito <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="district" id="district-select">
                                    <option hidden>Seleccione distrito</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase" id="address-label">Direccion <span
                                        class="text-danger">*</span></label>
                                <input class="form-control text-uppercase" name="address" type="text">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Referencia <span
                                        class="text-danger">*</span></label>
                                <input class="form-control text-uppercase" name="reference" type="text">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Información de pedido</p>
                    <div class="row" id="div-agency">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">AGENCIA <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="agency-select">
                                    <option hidden>Seleccione</option>
                                    @foreach ($agencies as $item)
                                        <option value="{{ $item->idAgency }}">{{ $item->agency }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Fecha de pedido
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control" name="date_order" type="date">
                            </div>
                        </div>
                        <div class="col-md-6" id="div-date-delivery">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Fecha de entrega
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control" name="date_delivery" type="date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="div-method">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Metodo de pago
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" name="method">
                                    <option hidden value="">Seleccione</option>
                                    @foreach ($methods as $item)
                                        <option value="{{ $item->idMethod }}">{{ $item->method }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="div-amount">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Monto a cobrar
                                    <span class="text-danger">*</span></label>
                                <input class="form-control" name="amount" type="text" pattern="\d+(\.\d{1,2})?"
                                    title="Ingrese un número válido (puede incluir hasta dos decimales)">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input"
                                    class="form-control-label text-uppercase">Observaciones</label>
                                <input class="form-control text-uppercase" type="text" name="observation">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Información de Articulo(s)</p>
                    <small class="text-xs"><i class="fas fa-info-circle"></i> Seleccione el artículo, luego digite
                        cantidad y agregue a la lisa de productos que enviará.</small>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Articulo(s)<span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="articleSelect">
                                    <option value=""></option>
                                    @foreach ($articles as $item)
                                        <option value="{{ $item->idArticle }}">{{ $item->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label text-uppercase">Cantidad de
                                    articulo<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" placeholder="Seleccione cantidad"
                                    name="quantity_article" id="quantity_article">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-4">
                                <button type="button" class="btn btn-warning" id="addButton">Agregar a listado <i
                                        class="fas fa-plus-square"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center" colspan="3">
                                        Listado de articulos a enviar</th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder d-none">ID</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Articulo</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Cantidad</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaArticulos">

                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
@section('js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('js/cliente1/order_form.js') }}"></script>
    <script>
        const csrfToken = '{{ csrf_token() }}';
    </script>
