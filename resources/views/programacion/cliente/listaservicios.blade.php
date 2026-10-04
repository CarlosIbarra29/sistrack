@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=1.2.8') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
  <script src="{{ asset('js/programacion/CatalogoProgramacionCliente.js?v=1.2.3') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
  Listado de Servicios
@endsection
@section('content')

<div class="servicios-cliente-page">

    <div class="servicios-cliente-header">
        <div>
            <span class="servicios-cliente-eyebrow">SERVICIOS CLIENTE</span>
            <h1 class="servicios-cliente-title">LISTADO DE SERVICIOS</h1>
            <p class="servicios-cliente-subtitle">Consulta y administra los servicios registrados para clientes.</p>
            {{-- <p class="text-muted m-0" style="font-size: 0.9rem;">Gestiona el alta, control y seguimiento de las cuentas y clientes de la plataforma.</p> --}}
        </div>

        @if(true)
            <a href="{{ route('procli.nuevoservicio') }}" class="servicios-cliente-new-btn">
                <i class="fas fa-user-plus"></i>
                <span>NUEVO SERVICIO</span>
            </a>
        @endif
    </div>

    <div class="servicios-cliente-filters">
        <div class="servicios-cliente-filter-field">
            <label>Buscar coincidencia</label>
            <div class="servicios-cliente-search-wrap">
                <i class="fas fa-search"></i>
                <input type="text"
                       class="form-control datatable-input servicios-cliente-search"
                       placeholder="Folio, origen, destino, transporte, operador, estatus...">
            </div>
        </div>

        <div class="servicios-cliente-filter-actions">
            <button type="button" class="servicios-cliente-btn servicios-cliente-btn--primary" id="kt_search">
                <i class="fas fa-search"></i>
                BUSCAR
            </button>
            <button type="button" class="servicios-cliente-btn servicios-cliente-btn--secondary" id="kt_reset">
                <i class="fas fa-undo"></i>
                LIMPIAR FILTROS
            </button>
        </div>
    </div>

    <div class="servicios-cliente-panel">
        <div class="servicios-cliente-panel-header">
            <div>
                <span class="servicios-cliente-eyebrow">SERVICIOS REGISTRADOS</span>
                <div class="servicios-cliente-panel-title-row">
                    <h6>LISTADO DE SERVICIOS</h6>
                    <span class="servicios-cliente-total">{{ count($data) }}</span>
                </div>
            </div>

            <div class="dropdown">
                <button type="button" class="servicios-cliente-export-btn" data-toggle="dropdown">
                    <i class="fas fa-download"></i>
                    EXPORTAR
                    <i class="fas fa-chevron-down servicios-cliente-export-chevron"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end servicios-cliente-export-menu">
                    <a href="#" class="dropdown-item" id="export-excel"><i class="la la-file-excel-o"></i>Excel</a>
                    <a href="#" class="dropdown-item" id="export-csv"><i class="la la-file-text-o"></i>CSV</a>
                    <a href="#" class="dropdown-item" id="export-print"><i class="la la-file-text-o"></i>Imprimir</a>
                </div>
            </div>
        </div>

        <div class="servicios-cliente-table-wrapper">
            <table class="table servicios-cliente-table" id="kdatatable_usuarios2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>DIRECCIÓN ORIGEN</th>
                        <th>DIRECCIÓN DESTINO</th>
                        <th>FECHA Y HORA DEL SERVICIO</th>
                        <th>ARMADA</th>
                        <th>LÍNEA DE TRANSPORTE</th>
                        <th>NOMBRE DEL OPERADOR</th>
                        <th>Estatus</th>
                        <th>Usuario</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $num = 1; @endphp
                    @foreach($data as $unid)
                        <tr>
                            <td class="servicios-cliente-id">{{ $unid->id }}</td>
                            <td>{{ $unid->ubicacion_origen  }} / {{ $unid->direccion_origen  }}</td>
                            <td>{{ $unid->ubicacion_destino  }} / {{ $unid->direccion_destino  }} </td>
                            <td>
                                <span class="servicios-cliente-date">{{ $unid->fechahora_servicio }}</span>
                            </td>
                            <td>
                                @if($unid->armada == 0) No @else Si @endif
                            </td>
                            <td>{{ $unid->linea_transporte  }}</td>
                            <td>{{ $unid->nombre_operador  }}</td>
                            <td>
                                @if($unid->estatus == 0)
                                    <span class="label font-weight-bold label-outline-warning label-inline servicios-cliente-status servicios-cliente-status--pending"> Pendiente</span>
                                @else
                                    <span class="label font-weight-bold label-outline-success label-inline servicios-cliente-status servicios-cliente-status--done"> Atendida</span>
                                @endif
                            </td>
                            <td>{{ $unid->userCreated->name  }}</td>
                            <td class="text-center">
                                <div class="servicios-cliente-actions">
                                    <a href="{{ route('procli.verservicio', $unid->id) }}" class="servicios-cliente-action" title="Ver servicio" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                        <i class="far fa-eye"></i>
                                    </a>

                                    @if($role != 17)
                                        @if($unid->programacion_id == null || $unid->programacion_id == "" )
                                            <a href="{{ route('procli.complementarservicio', $unid->id) }}" class="servicios-cliente-action" title="Complementar servicio" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php $num ++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <div>Mostrando registros del 1 al {{ count($data) }} de un total de {{ count($data) }} registros</div> --}}
    </div>
</div>

<form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_cliente_delete" value="">
</form>

<input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection
