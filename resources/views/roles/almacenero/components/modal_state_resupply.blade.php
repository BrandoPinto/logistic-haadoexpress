<div class="modal fade" id="modal-state-resupply" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Estado de Reabastecimiento</h3>
                        <p class="font-weight-bold mb-0">¿Actualizar el estado del reabastecimiento?</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.resupply') }}" method="POST">
                            @csrf
                            <input hidden type="number" name="id" id="idInput">
                            <div class="text-center">
                                <div class="btn-group p-2 d-block">
                                    <button type="button" class="btn btn-danger btn-lg m-1"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-warning btn-lg m-1">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
