<div class="modal fade" id="modal-assign-fulfillment" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Asignar fulfillment a articulo</h3>
                        <p class="font-weight-bold mb-0">Seleccione el tipo adecuado.</p>
                    </div>
                    @php
                        $fulfillment = \App\Models\Fulfillment::all();
                    @endphp
                    <div class="card-body">
                        <form action="{{ route('assign.fulfillment') }}" method="POST">
                            @csrf
                            <input hidden class="form-control" type="number" name="idArticle" id="idArticle">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Delivery <span class="text-danger">*</span></label>
                                        <select required class="form-control" name="idFulfillment">
                                            <option hidden>Seleccione</option>
                                            @foreach ($fulfillment as $item)
                                                <option class="text-uppercase" value="{{ $item->idFulfillment }}">
                                                    {{ $item->fulfillment.' | S/'.$item->amount }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
