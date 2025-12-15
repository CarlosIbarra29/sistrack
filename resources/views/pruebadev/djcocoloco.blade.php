@extends('layouts.app')

@section('title')
    Catálogo de clientes inactivos
@endsection

@push('scripts')
    <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('content')

<style>
/* ================= PAGINACIÓN MEJORADA ================= */
.dataTables_wrapper .dataTables_info {
    font-size: 13px;
    color: #7e8299;
    padding-top: 12px;
}

.dataTables_wrapper .dataTables_paginate {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 6px;
    padding-top: 10px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    min-width: 36px;
    height: 36px;
    line-height: 36px;
    padding: 0 12px;
    margin: 0 2px;
    border-radius: 8px;
    border: 1px solid #e4e6ef;
    background: #ffffff;
    color: #7e8299 !important;
    font-weight: 500;
    transition: all .2s ease;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #fff4de !important;
    border-color: #ffa800;
    color: #000 !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #ffa800 !important;
    border-color: #ffa800;
    color: #000 !important;
    font-weight: 600;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* Responsive */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_paginate {
        justify-content: center;
    }
}
</style>

<div class="d-flex flex-row">
    <div class="flex-row-fluid">
        <div class="d-flex flex-column flex-grow-1">
            <div class="row">
                <div class="col-xl-12">

                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-file text-warning"></i>
                                </span>
                                <h3 class="card-label">
                                    Inventario de clientes inactivos
                                    <small class="text-muted d-block mt-1">
                                        Clientes sin actividad reciente
                                    </small>
                                </h3>
                            </div>

                            <div class="card-toolbar">
                                <a href="{{ route('cliente.listadocliente') }}"
                                   class="btn btn-light-warning font-weight-bold">
                                   <i class="la la-arrow-left"></i> Regresar
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover table-checkable"
                                   id="kdatatable_clientes_inactivos">

                                <thead>
                                <tr>
                                    <th>Razón social</th>
                                    <th>Nombre cliente</th>
                                    <th>Grupo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $unid)
                                    <tr>
                                        <td>{{ $unid->razon_social }}</td>
                                        <td>{{ $unid->nombre_cliente }}</td>
                                        <td>
                                            <span class="label label-inline label-light-warning font-weight-bold">
                                                Grupo {{ $unid->grupo }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button
                                                class="btn btn-icon btn-outline-warning activar-cliente"
                                                data-id="{{ $unid->id }}"
                                                data-nombre="{{ $unid->razon_social }}"
                                                data-toggle="tooltip"
                                                title="Activar cliente">
                                                <i class="flaticon2-reply"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                            <input type="hidden" id="datatable_i18n"
                                   value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<form method="post" id="cliente_act_form"
      action="{{ route('cliente.activarcliente') }}">
    @csrf
    <input type="hidden" name="id" id="id_delete">
</form>

@endsection
