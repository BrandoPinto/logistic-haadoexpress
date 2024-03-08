<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pedidos Entregados</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $idUser = auth()->user()->id;
                                    $orders_realized = \App\Models\Order::where('idUser', $idUser)
                                        ->where('state', 1)
                                        ->count();
                                    $orders_earrings = \App\Models\Order::where('idUser', $idUser)
                                        ->where('state', 2)
                                        ->count();
                                @endphp
                                {{ $orders_realized }}
                            </h5>
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">{{ $orders_earrings }}</span>
                                pendiente(s)
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="fas fa-truck text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Mis articulos</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $articles = \App\Models\Article::where('idUser', $idUser)->count();
                                @endphp
                                {{ $articles }}
                            </h5>
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder"></span>
                                Stock
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="fas fa-boxes text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Ingresos por pedidos entregado</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $now = now();
                                    $currentMonthAmount = \App\Models\Order::where('idUser', $idUser)
                                        ->where('state', 1)
                                        ->whereYear('real_date', $now->year)
                                        ->whereMonth('real_date', $now->month)
                                        ->sum('amount');

                                    $lastMonth = $now->subMonth();
                                    $lastMonthAmount = \App\Models\Order::where('idUser', $idUser)
                                        ->where('state', 1)
                                        ->whereYear('real_date', $lastMonth->year)
                                        ->whereMonth('real_date', $lastMonth->month)
                                        ->sum('amount');

                                    $difference = $currentMonthAmount - $lastMonthAmount;
                                    $difference = max(0, $difference);
                                @endphp
                                S/{{ $currentMonthAmount }}
                            </h5>
                            <p class="mb-0">
                                <span class="text-danger text-sm font-weight-bolder">S/{{ $difference }}</span>
                                más que el mes pasado
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="fas fa-wallet text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Reabastecimientos en el mes</p>
                            <h5 class="font-weight-bolder">
                                @php
                                    $now = now();
                                    $currentMonthResupplies = \App\Models\Resupply::where('idUser', $idUser)
                                        ->where('state', 1)
                                        ->whereYear('date', $now->year)
                                        ->whereMonth('date', $now->month)
                                        ->count();

                                    $lastMonth = $now->subMonth();
                                    $lastMonthResupplies = \App\Models\Resupply::where('idUser', $idUser)
                                        ->where('state', 1)
                                        ->whereYear('date', $lastMonth->year)
                                        ->whereMonth('date', $lastMonth->month)
                                        ->count();
                                @endphp
                                {{ $currentMonthResupplies }}
                            </h5>
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">{{ $lastMonthResupplies }}</span>
                                en el mes pasado
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Ganancias mes <span id="month"></span></h6>
                <p class="text-sm mb-0">
                    <i class="fa fa-arrow-up text-success"></i>
                    <span class="font-weight-bold"></span> Mes actual
                </p>
            </div>
            <div class="card-body p-3">
                <div class="chart h-100"> <!-- Ajusta el alto del contenedor del gráfico -->
                    <canvas id="chart-line" class="chart-canvas" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card card-carousel overflow-hidden h-100 p-0">
            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                <div class="carousel-inner border-radius-lg h-100">
                    @foreach ($blog as $index => $item)
                            <div class="carousel-item h-100 @if ($index === 0) active @endif">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->caption }}"
                                    class="d-block img-fluid">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="fas fa-newspaper text-dark opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-2">Últimos 5 pedidos</h6>
                </div>
            </div>
            @php
                $orders = \App\Models\Order::where('idUser', $idUser)
                    ->orderBy('idOrders', 'desc')
                    ->limit(5) 
                    ->get();
            @endphp
            <div class="table-responsive">
                <table class="table align-items-center ">
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                            <img src="./img/orders.png" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Codigo:</p>
                                            <h6 class="text-sm mb-0">{{ $item->code }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Cliente:</p>
                                        <h6 class="text-sm mb-0">{{ $item->name }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Fecha de entrega:</p>
                                        <h6 class="text-sm mb-0">{{ date('d/m/Y', strtotime($item->date_delivery)) }}</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Estado:</p>
                                        <h6 class="text-sm mb-0">
                                            @if ($item->state == 1)
                                            <span class="badge badge-sm bg-gradient-success">Entregado</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-danger">No Entregado</span>
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        {{--  
        <div class="card">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Categories</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                <i class="ni ni-mobile-button text-white opacity-10"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">Devices</h6>
                                <span class="text-xs">250 in stock, <span class="font-weight-bold">346+
                                        sold</span></span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button
                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                    class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                <i class="ni ni-tag text-white opacity-10"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                                <span class="text-xs">123 closed, <span class="font-weight-bold">15
                                        open</span></span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button
                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                    class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                <i class="ni ni-box-2 text-white opacity-10"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                                <span class="text-xs">1 is active, <span class="font-weight-bold">40
                                        closed</span></span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button
                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                    class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                <i class="ni ni-satisfied text-white opacity-10"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                                <span class="text-xs font-weight-bold">+ 430</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button
                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                    class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        --}}
    </div>
</div>

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script src="{{ asset('js/cliente1/dashboard.js') }}"></script>
    <script>
        //CHART JS
        var ctx = document.getElementById('chart-line').getContext('2d');
        var weeklyIncomes = {!! $weeklyIncomes !!};

        var labels = [];
        var data = [];

        for (var i = 1; i <= 5; i++) {
            var weekIncome = weeklyIncomes.find(function(income) {
                return income.week === i;
            });

            labels.push('Semana ' + i);
            data.push(weekIncome ? weekIncome.total : 0);
        }

        var chartData = {
            labels: labels,
            datasets: [{
                label: 'Ganancia por semana',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }]
        };

        var options = {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }

        };

        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: options
        });
    </script>
@endpush
