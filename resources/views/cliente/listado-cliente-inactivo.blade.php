@extends('layouts.app')
@section('title')
    Catálogo de clientes inactivos
@endsection
@push('scripts')
    <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h2 class="font-weight-bold mb-1">Inventario de clientes inactivos</h2>
                    </div>

        <a href="{{ route('cliente.listadocliente') }}" class="btn btn-warning font-weight-bold"><i class="flaticon2-back"></i> Regresar</a>
    </div>

    <!-- Card -->
    <div class="card card-custom shadow-sm">
        <div class="card-body">

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover table-checkable" id="kdatatable_usuarios2">
                    <thead>
                        <tr>
                            <th>Razón social</th>
                            <th>Nombre del cliente</th>
                            <th>Grupo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $unid)
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-dark">
                                        {{ $unid->razon_social }}
                                    </span>
                                </td>

                                <td>{{ $unid->nombre_cliente }}</td>

                                <td>
                                    <span class="label label-inline label-light-primary font-weight-bold">
                                        {{ $unid->grupo }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <button
                                        class="btn btn-icon btn-light-warning activar-cliente"
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

                    <tfoot>
                        <tr>
                            <th>Razón social</th>
                            <th>Nombre del cliente</th>
                            <th>Grupo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <input type="hidden"
                   id="datatable_i18n"
                   value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
        </div>
    </div>
</div>

<!-- Form Activar Cliente -->
<form method="post"
      id="cliente_act_form"
      action="{{ route('cliente.activarcliente') }}">
    @csrf
    <input type="hidden" name="id" id="id_delete">
</form>

@endsection
