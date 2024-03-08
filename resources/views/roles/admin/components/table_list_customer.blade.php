<div class="table-responsive p-2">
    <table class="table align-items-center mb-0 table-users">
        <thead class="text-white">
            <tr class="bg-primary text-white">
                <th class="text-uppercase text-center text-xxs font-weight-bolder" colspan="5">LISTADO DE CLIENTES</th>
            </tr>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Empresa/Nombre</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Celular</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $item)
                <tr @if ($loop->last) class="last-row" @endif>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" class="avatar avatar-sm me-3">
                                @else
                                    <img src="/img/profile.png" class="avatar avatar-sm me-3">
                                @endif
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                @php
                                    $name_lastname = '';
                                    if ($item->id_rol == 1 || $item->id_rol == 4 || $item->id_rol == 5 || $item->id_rol == 6) {
                                        $name_lastname = $item->company_name;
                                    } elseif ($item->id_rol == 2 || $item->id_rol == 3) {
                                        $name_lastname = $item->firstname . ' ' . $item->lastname;
                                    }
                                @endphp
                                <h6 class="mb-0 text-sm text-uppercase"> {{ $name_lastname }} </h6>
                                <p class="text-xs text-secondary mb-0">{{ $item->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">Cliente | <i class="fas fa-user"></i></td>
                    <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">{{ $item->celphone }}</span>
                    </td>
                    <td class="align-middle text-sm">
                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Botones de acción">
                            <form action="{{ route('customer.history') }}" method="POST">
                                @csrf
                                <input hidden type="number" name="id" value="{{ $item->id }}">
                                <button disabled class="btn btn-warning btn-customer m-1" type="submit" data-type="1"
                                    data-id="{{ $item->id }}">
                                    <i class="fas fa-clipboard-list"></i>
                                </button>
                            </form>

                            <form action="{{ route('customer.profile') }}" method="POST">
                                @csrf
                                <input hidden type="number" name="id" value="{{ $item->id }}">
                                <button class="btn btn-primary btn-customer m-1" type="submit" data-type="2"
                                    data-id="{{ $item->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>

                            <form action="{{ route('customer.terminate') }}" method="POST">
                                @csrf
                                <input hidden type="number" name="id" value="{{ $item->id }}">
                                <button class="btn btn-danger btn-customer m-1" type="submit" data-type="3"
                                    data-id="{{ $item->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
