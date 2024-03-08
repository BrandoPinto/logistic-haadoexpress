<div class="modal fade" id="modal-new-subemail" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Nuevo usuario - Sub cuenta</h3>
                        <p class="mb-0">Ingrese todos los datos necesarios.</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('new.subemail') }}" method="POST">
                            @csrf
                            <input hidden type="number" name="idUser" value="{{ $user->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required type="email" class="form-control"
                                            name="email" placeholder="Email" value="@haadoexpress.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required type="password" class="form-control"
                                            name="password">
                                    </div>
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
