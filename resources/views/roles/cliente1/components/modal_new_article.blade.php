<div class="modal fade" id="modal-new-article" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Nuevo Articulo</h3>
                        <p class="mb-0">Ingrese los datos necesarios</p>
                    </div>
                    <div class="card-body">
                        <form id="form-new-customer" action="{{ route('article.store') }}" method="POST">
                            @csrf
                            <label>Descripción <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input required type="text" class="form-control text-uppercase" name="description"
                                    placeholder="Descripción del artículo">
                            </div>
                            <label>Stock</label>
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control" name="stock" value="0">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fulfillment">
                                <label class="form-check-label">Requiere fulfillment   <i class="fas fa-info-circle ms-auto text-dark cursor-pointer"
                                  data-bs-toggle="tooltip" data-bs-placement="top" title="Fulfillment es el servicio de armado de su articulo, o sea si necesita que lo armemos antes de entregarlo. Sí es así tiene un costo mínimo del que se le informará en adelante."></i></label>
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
