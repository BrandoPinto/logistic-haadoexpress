<div class="modal fade" id="modal-new-customer" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Nuevo usuario</h3>
                        <p class="mb-0">Ingrese todos los datos necesarios.</p>
                    </div>
                    <div class="card-body">
                        <form id="form-new-customer" action="{{ route('new.customer') }}" method="POST">
                            @csrf
                            <label>Tipo de usuario</label>
                            <div class="input-group mb-3">
                                <select required class="form-control" name="rol" id="rolSelect">
                                    <option hidden>Elige opción</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Almacenero</option>
                                    <option value="3">Delivery</option>
                                    <option value="4">Cliente</option>
                                </select>
                            </div>

                            <div class="row" id="infoEmpresaRow" style="display: none;">
                                <p class="text-uppercase text-sm">Información de empresa</p>
                                <div class="col-md-6">
                                    <label>Tipo de cliente</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="type_customer" id="typeCustomerSelect">
                                            <option hidden>Seleccione</option>
                                            <option value="4">Dropshipping</option>
                                            <option value="5">Cliente 2</option>
                                            <option value="6">Cliente 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Nombre de empresa</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control text-uppercase"
                                            name="company_name" placeholder="Nombre de empresa">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <p class="text-uppercase text-sm">Información de contacto</p>
                                <div class="col-md-6">
                                    <label>Nombre <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required type="text" class="form-control text-uppercase"
                                            name="firstname" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Apellidos <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required type="text" class="form-control text-uppercase"
                                            name="lastname" placeholder="Apellidos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>DNI <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required type="number" class="form-control text-uppercase"
                                            name="dni" placeholder="DNI">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Celular <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required type="number" class="form-control text-uppercase"
                                            name="celphone" placeholder="Celular">
                                    </div>
                                </div>
                            </div>
                            <label>Email <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input required type="email" class="form-control" name="email" placeholder="Email"
                                    aria-label="Email" value="@haadoexpress.com" aria-describedby="email-addon">
                            </div>
                            <label>Password <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input required type="password" class="form-control" name="password" id="passwordInput"
                                    placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                <div class="input-group-append">
                                    <i class="fas fa-eye" id="togglePassword"></i>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-round bg-primary btn-lg w-100 text-white mt-2 mb-0">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
