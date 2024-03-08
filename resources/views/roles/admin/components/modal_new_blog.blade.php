<div class="modal fade" id="modal-new-customer" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Nuevo blog</h3>
                        <p class="mb-0">Ingrese todos los datos necesarios.</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="fas fa-info-circle"></i></span>
                            <span class="alert-text"><strong>Sugerencia!</strong> Un tamaño adecuado sería 800 x 450</span>
                        </div>
                        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Imagen <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input required type="file" class="form-control" name="image">
                            </div>
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
