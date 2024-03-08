<div class="modal fade" id="modal-edit-articles" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card card-plain">
          <div class="card-header pb-0 text-left">
            <h3 class="font-weight-bolder text-primary">Editar Articulo</h3>
            <p class="mb-0">Ingrese los datos necesarios</p>
          </div>
          <div class="card-body">
            <form id="form-new-customer" action="{{ route('article.update') }}" method="POST">
              @csrf
              <input hidden type="number" name="idArticle" id="id_input">
              <label>Descripción <span class="text-danger">*</span></label>
              <div class="input-group mb-3">
                <input type="text" class="form-control text-uppercase" name="description" id="description_input">
              </div>         
              <div class="text-center">
                <button type="submit" class="btn btn-round bg-primary btn-lg w-100 text-white mt-2 mb-0">Actualizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>