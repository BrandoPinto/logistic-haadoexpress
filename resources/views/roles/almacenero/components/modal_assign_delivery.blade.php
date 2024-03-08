<div class="modal fade" id="modal-assign-delivery" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Asigne delivery a pedido</h3>
                        <p class="mb-0">Seleccione delivery adecuado</p>
                    </div>
                    <div class="card-body">
                        <form id="form-new-customer" action="{{ route('assign.delivery') }}" method="POST">
                            @csrf
                            <input hidden class="form-control" type="number" name="idOrders" id="idOrders">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Delivery <span class="text-danger">*</span></label>
                                        <select required class="form-control" name="idDelivery" id="">
                                            <option hidden>Seleccione</option>
                                            @foreach ($deliveries as $item)
                                                <option class="text-uppercase" value="{{ $item->id }}">
                                                    {{ $item->firstname . ' ' . $item->lastname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="btn-group p-2 d-block">
                                    <button type="button" class="btn btn-danger btn-lg m-1"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-warning btn-lg m-1">Asignar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
