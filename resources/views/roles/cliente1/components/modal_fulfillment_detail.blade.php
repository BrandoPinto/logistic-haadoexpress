<div class="modal fade" id="modal-fulfillment-detail" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Detallado de Fulfillment</h3>
                        <p class="mb-0"></p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Pedido</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Dirección de entrega</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Costo delivery</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalDelivery = 0;
                                    @endphp
                                    @foreach ($orders as $item)
                                        @php
                                            $totalDelivery += $item->tariff;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="/img/orders.png" class="avatar avatar-sm me-3"
                                                            alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->code }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-uppercase">
                                                    {{ $item->address . ' - ' . $item->district }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">S/{{ $item->tariff }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-primary text-white text-center">
                                        <td colspan="2" class="text-end text-uppercase"><strong>Total:</strong></td>
                                        <td><strong>S/{{ $totalDelivery }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
