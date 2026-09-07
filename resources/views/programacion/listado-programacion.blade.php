@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=1.0.3') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('js/programacion/CatalogoProgramacion.js?v=1.3.6') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/programacion/AgregarProgramacionUnique.js') }}"></script>
@endpush

@section('title')
    Programación de Servicios
@endsection

@section('content')
<div class="dashboard-dark programacion-page">

    {{-- ENCABEZADO --}}
    <header class="programacion-page-header">
        <div>
            <h2 class="programacion-page-title">PROGRAMACIÓN DE SERVICIOS</h2>
            <p class="programacion-page-subtitle">
                Administra y programa los servicios de custodia y traslado.
            </p>
        </div>

        <div class="programacion-header-actions">
            <!-- <a href="{{ route('programacion.nuevaprogramacion') }}"
               class="btn btn-gold programacion-header-btn">
                <i class="la la-plus"></i>
                <span>NUEVO SERVICIO</span>
            </a> -->

            <a href="{{ route('programacion.programacioninactivas') }}"
               class="btn btn-outline-custom programacion-header-btn">
                <i class="far fa-trash-alt"></i>
                <span>CLIENTES INACTIVOS</span>
            </a>

            <button type="button"
                    class="btn btn-outline-custom programacion-header-btn">
                <i class="fa fa-file-excel"></i>
                <span>IMPORTAR EXCEL</span>
            </button>

            <button type="button"
                    class="btn btn-outline-custom programacion-header-btn">
                <i class="fa fa-download"></i>
                <span>EXPORTAR</span>
            </button>
        </div>
    </header>

    {{-- DATOS DEL SERVICIO --}}
    <section class="panel-dark programacion-form-panel is-collapsed" >

        <div class="programacion-card-header">
            <div>
                <span class="programacion-eyebrow">NUEVA PROGRAMACIÓN</span>
                <h6>DATOS DEL SERVICIO</h6>
            </div>

            <button type="button"
                    id="btnToggleProgramacion"
                    class="programacion-collapse-btn"
                    aria-expanded="false"
                    aria-controls="programacionFormCollapse">
                <span class="programacion-collapse-btn__text">Nuevo servicio</span>
                <span class="programacion-collapse-btn__indicator"></span>
            </button>
        </div>
        <div id="programacionFormCollapse" class="programacion-form-collapse is-collapsed">
            <div class="programacion-form-collapse__inner">

                <form action="{{ route('programacion.guardarprogramacionnew') }}"
                      method="post"
                      id="submit_programacion"
                      enctype="multipart/form-data"
                      class="programacion-form">

                    @csrf

                    <input type="hidden"
                           id="tipoArchivo"
                           value="{{ $cadenaTipoDocumento }}">

                    <div class="programacion-form-grid">

                        {{-- ORIGEN --}}
                        <section class="form-row-section form-row-section--origen">

                            <div class="section-meta">
                                <span class="section-number">01</span>

                                <div>
                                    <h3>Cliente</h3>
                                    <p>
                                        Cliente solicitante, horario y variables del servicio.
                                    </p>
                                </div>
                            </div>

                            <div class="section-controls">

                                <div class="programacion-field-grid programacion-field-grid--origin">

                                    <div class="form-group programacion-field-client">
                                        <label class="app-label">
                                            Razón Social *
                                        </label>

                                        <select class="form-control app-input"
                                                id="cliente_id"
                                                name="cliente_id"
                                                required>

                                            <option value="" disabled selected>
                                                Buscar y seleccionar cliente...
                                            </option>

                                            @foreach($cliente as $cli)
                                                <option value="{{ $cli->id }}">
                                                    {{ $cli->nombre_cliente }} / {{ $cli->razon_social }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group programacion-field-date">
                                        <label class="app-label">
                                            Fecha y hora de servicio *
                                        </label>

                                        <input type="datetime-local"
                                               class="form-control app-input"
                                               name="fecha_hora"
                                               id="fecha_hora"
                                               required>
                                    </div>

                                    <div class="form-group programacion-choice-block">
                                        <label class="app-label">
                                            Tipo de servicio
                                        </label>

                                        <div class="compact-radio-group">

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       checked
                                                       name="tipo_servicio"
                                                       value="0">

                                                <span>
                                                    <i class="la la-road"></i>
                                                    Foráneo
                                                </span>
                                            </label>

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       name="tipo_servicio"
                                                       value="1">

                                                <span>
                                                    <i class="la la-map-marker"></i>
                                                    Local
                                                </span>
                                            </label>

                                        </div>
                                    </div>

                                    <div class="form-group programacion-choice-block">
                                        <label class="app-label">
                                            Armado
                                        </label>

                                        <div class="compact-radio-group">

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       checked
                                                       name="armado_servicio"
                                                       value="1">

                                                <span>
                                                    <i class="la la-check"></i>
                                                    Sí
                                                </span>
                                            </label>

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       name="armado_servicio"
                                                       value="2">

                                                <span>
                                                    <i class="la la-times"></i>
                                                    No
                                                </span>
                                            </label>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </section>

                        {{-- RUTAS --}}
                        <section class="form-row-section form-row-section--rutas">

                            <div class="section-meta">
                                <span class="section-number">02</span>

                                <div>
                                    <h3>Origen-Destino</h3>
                                    <p>
                                        Puntos geográficos controlados de partida y destino.
                                    </p>
                                </div>
                            </div>

                            <div class="section-controls">

                                <div class="programacion-field-grid">

                                    <div class="form-group">
                                        <label class="app-label">
                                            Domicilio origen *
                                        </label>

                                        <input type="text"
                                               class="form-control app-input"
                                               name="dom_origen"
                                               id="dom_origen"
                                               placeholder="Dirección origen del servicio"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label class="app-label">
                                            Domicilio destino *
                                        </label>

                                        <input type="text"
                                               class="form-control app-input"
                                               name="dom_destino"
                                               id="dom_destino"
                                               placeholder="Dirección destino del servicio"
                                               required>
                                    </div>

                                    <div class="form-group programacion-field-status">
                                        <label class="app-label">
                                            Estatus *
                                        </label>

                                        <div class="programacion-status-select">
                                            <i class="la la-flag"></i>

                                            <select class="form-control app-input"
                                                    id="programacion_id"
                                                    name="programacion_id"
                                                    required>

                                                <option value="" disabled selected>
                                                    Selecciona el estatus
                                                </option>

                                                @foreach($estatus_programacion_data as $estatus)
                                                    <option value="{{ $estatus->id }}">
                                                        {{ $estatus->estatus_programacion }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </section>

                        {{-- PERSONAL --}}
                        <section class="form-row-section form-row-section--personal">

                            <div class="section-meta">
                                <span class="section-number">03</span>

                                <div>
                                    <h3>Personal</h3>
                                    <p>
                                        Custodio principal y acompañantes secundarios.
                                    </p>
                                </div>
                            </div>

                            <div class="section-controls">

                                <div class="programacion-field-grid programacion-field-grid--personal">

                                    <div class="form-group">
                                        <label class="app-label">
                                            Custodio Principal *
                                        </label>

                                        <select class="form-control app-input"
                                                id="custodio_id"
                                                name="custodio_id"
                                                required>

                                            <option value="" disabled selected>
                                                Asignar custodio...
                                            </option>

                                            @foreach($custodio as $cli)
                                                <option value="{{ $cli->id }}">
                                                    {{ $cli->nombre_custodio }}
                                                    {{ $cli->ap_paterno }}
                                                    {{ $cli->ap_materno }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="app-label">
                                            ¿Lleva Acompañantes?
                                        </label>

                                        <div class="compact-radio-group">

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       name="op_custodios"
                                                       id="op_c_uno"
                                                       value="0" />

                                                <span>
                                                    <i class="la la-user-plus"></i>
                                                    Sí
                                                </span>
                                            </label>

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       checked
                                                       name="op_custodios"
                                                       id="op_c_dos"
                                                       value="1" />

                                                <span>
                                                    <i class="la la-user"></i>
                                                    No
                                                </span>
                                            </label>

                                        </div>
                                    </div>

                                </div>

                                {{-- ACOMPAÑANTES --}}
                                <div id="div_custodios"
                                     class="programacion-extra-custodios">

                                    <label class="app-label programacion-extra-title">
                                        Acompañantes Extras
                                    </label>

                                    <div class="table-responsive programacion-extra-table-wrapper">

                                        <table class="table table-bordered m-0 text-white programacion-extra-table"
                                               id="tblDocumentos">

                                            <thead>
                                                <tr>
                                                    <th>Custodio</th>
                                                    <th class="text-center programacion-extra-option">
                                                        Opción
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbodyDocumentos"></tbody>

                                        </table>

                                    </div>

                                    <a href="#"
                                       class="btn btn-action-secondary btn-sm hrefAgregarOtro programacion-add-extra">

                                        <i class="flaticon2-plus"></i>
                                        Agregar otro

                                    </a>

                                </div>

                            </div>
                        </section>

                    </div>

                    {{-- NOTAS + ACCIONES --}}
                    <div class="programacion-form-bottom">

                        <section class="programacion-notes-block">

                            <div class="section-meta section-meta--inline">
                                <span class="section-number">04</span>

                                <div>
                                    <h3>Notas</h3>
                                    <p>
                                        Observaciones críticas u operacionales a considerar.
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control app-input programacion-notes"
                                          name="observaciones"
                                          placeholder="Escriba comentarios adicionales aquí..."
                                          id="observaciones"
                                          rows="3"></textarea>
                            </div>

                        </section>

                        <div class="panel-footer-actions">

                            <a href="{{ route('programacion.listadoprogramacion') }}"
                               class="btn btn-action-secondary">

                                <i class="la la-undo"></i>
                                Limpiar Todo

                            </a>

                            <button type="button"
                                    id="btnGuardar"
                                    class="btn btn-action-primary">

                                <i class="la la-save"></i>
                                Guardar Registro

                            </button>

                        </div>

                    </div>

                </form>
            
            </div>
        </div>
    </section>

    {{-- SERVICIOS PROGRAMADOS + DISPONIBILIDAD --}}
    <div class="programacion-main-grid">

        {{-- SERVICIOS PROGRAMADOS --}}
        <section class="programacion-services-column">

            <div class="panel-dark programacion-services-panel">

                <div class="programacion-services-header">

                    <div>
                        <span class="programacion-eyebrow">
                            OPERACIÓN
                        </span>

                        <h6>
                            SERVICIOS PROGRAMADOS

                            <span class="programacion-total">
                                {{ $programcion->count() }}
                            </span>
                        </h6>
                    </div>

                    <div class="programacion-search-wrapper">

                        <i class="la la-search"></i>

                        <input type="text"
                               id="servicios_programados_buscar"
                               class="form-control custom-input programacion-service-search"
                               placeholder="Buscar por cliente, origen, destino, custodio..."
                               autocomplete="off">

                    </div>

                </div>

                <div class="table-responsive programacion-services-table-wrapper">

                    <table class="table-custom programacion-services-table"
                           id="servicios_programados_table">

                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Día Salida</th>
                                <th>Hora salida</th>
                                <th>Cliente</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Custodio</th>
                                <th>Estatus</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($programcion as $unid)

                                <tr>

                                    <td class="programacion-table-time">
                                        {{ $unid->folio }}
                                    </td>

                                    <td class="programacion-table-time">
                                        {{ date('d-m-Y', strtotime($unid->fecha_servicio)) }}
                                    </td>

                                    <td class="programacion-table-time">
                                        {{ date('H:i', strtotime($unid->fecha_servicio)) }}
                                    </td>

                                    <td class="programacion-table-client">
                                        {{ $unid->nombre_cliente }}
                                    </td>

                                    <td class="programacion-table-route"
                                        title="{{ $unid->dom_origen }}">
                                        {{ $unid->dom_origen }}
                                    </td>

                                    <td class="programacion-table-route"
                                        title="{{ $unid->dom_destino }}">
                                        {{ $unid->dom_destino }}
                                    </td>

                                    <td>

                                        <div class="programacion-custodio-cell">

                                            <div class="programacion-custodio-avatar">
                                                <span>
                                                    {{ substr($unid->custodio->nombre_custodio ?? 'S', 0, 1) }}
                                                </span>
                                            </div>

                                            <span class="programacion-custodio-name">
                                                {{ $unid->custodio->nombre_custodio ?? 'Sin asignar' }}
                                            </span>

                                        </div>

                                    </td>

                                    <td>
                                        <span class="badge-status status-programado">
                                            {{ $unid->estatus_programacion }}
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        <div class="programacion-row-actions">

                                            <a href="#"
                                               class="programacion-row-action text-gold"
                                               data-toggle="modal"
                                               data-target="#model_add_incidencia"
                                               onclick="$('#id_programacion').val({{ $unid->id }})"
                                               title="Ver observaciones">

                                                <i class="flaticon-eye"></i>

                                            </a>

                                            <a href="{{ route('programacion.editarprogramacion', $unid->id) }}"
                                               class="programacion-row-action text-muted"
                                               title="Editar programcion">

                                                <i class="la la-edit"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="programacion-table-footer">

                    <div id="servicios_programados_info"
                         class="programacion-table-info">
                    </div>

                    <div id="servicios_programados_paginador"
                         class="programacion-pagination">
                    </div>

                </div>

            </div>

        </section>

        {{-- COLUMNA DERECHA --}}
        <aside class="programacion-sidebar-column">

            {{-- DISPONIBILIDAD --}}
            <div class="panel-dark programacion-side-card">

                <div class="programacion-side-card-header">

                    <div>
                        <span class="programacion-eyebrow">
                            RECURSOS
                        </span>

                        <h6>
                            DISPONIBILIDAD DE CUSTODIOS
                        </h6>
                    </div>

                    <a href="#">
                        Ver todos
                    </a>

                </div>

                <div class="programacion-status-list">

                    <div class="programacion-status-item">
                        <span class="risk-dot bg-bajo"></span>
                        <div>
                            <strong>Juan Pérez</strong>
                            <small>Disponible</small>
                        </div>
                    </div>

                    <div class="programacion-status-item">
                        <span class="risk-dot bg-bajo"></span>
                        <div>
                            <strong>Carlos Ruiz</strong>
                            <small>Disponible</small>
                        </div>
                    </div>

                    <div class="programacion-status-item">
                        <span class="risk-dot bg-medio"></span>
                        <div>
                            <strong>Miguel Torres</strong>
                            <small>En servicio</small>
                        </div>
                    </div>

                    <div class="programacion-status-item">
                        <span class="risk-dot bg-bajo"></span>
                        <div>
                            <strong>José Martínez</strong>
                            <small>Disponible</small>
                        </div>
                    </div>

                    <div class="programacion-status-item">
                        <span class="risk-dot bg-alto"></span>
                        <div>
                            <strong>Pedro López</strong>
                            <small>No disponible</small>
                        </div>
                    </div>

                </div>

                <div class="programacion-side-footer">
                    <a href="#">
                        VER TODOS LOS CUSTODIOS
                        <span>→</span>
                    </a>
                </div>

            </div>

            {{-- ALERTAS --}}
            <div class="panel-dark programacion-alert-card">

                <div class="programacion-side-card-header">
                    <div>
                        <span class="programacion-eyebrow">
                            ATENCIÓN
                        </span>

                        <h6>
                            ALERTAS DE PROGRAMACIÓN
                        </h6>
                    </div>
                </div>

                <div class="programacion-alert-list">

                    <div class="programacion-alert-item">
                        <span>
                            <i class="fa fa-exclamation-triangle text-danger"></i>
                            3 servicios sin custodio
                        </span>

                        <i class="fa fa-chevron-right"></i>
                    </div>

                    <div class="programacion-alert-item">
                        <span>
                            <i class="fa fa-exclamation-triangle text-warning"></i>
                            2 servicios sin unidad
                        </span>

                        <i class="fa fa-chevron-right"></i>
                    </div>

                    <div class="programacion-alert-item">
                        <span>
                            <i class="fa fa-exclamation-triangle text-danger"></i>
                            1 servicio con riesgo alto
                        </span>

                        <i class="fa fa-chevron-right"></i>
                    </div>

                </div>

            </div>

        </aside>

    </div>

    {{-- LEYENDAS --}}
    <div class="panel-dark programacion-legends">

        <div class="programacion-status-legend">

            <h6>
                LEYENDA DE ESTATUS
            </h6>

            <div class="programacion-legend-items">

                <div>
                    <span class="badge-status status-programado">
                        PROGRAMADO
                    </span>
                    <small>Servicio programado</small>
                </div>

                <div>
                    <span class="badge-status status-encurso">
                        EN CURSO
                    </span>
                    <small>Servicio activo</small>
                </div>

                <div>
                    <span class="badge-status status-enruta">
                        EN RUTA
                    </span>
                    <small>En ruta al destino</small>
                </div>

                <div>
                    <span class="badge-status status-finalizado">
                        FINALIZADO
                    </span>
                    <small>Servicio finalizado</small>
                </div>

                <div>
                    <span class="badge-status status-sinasignar">
                        SIN ASIGNAR
                    </span>
                    <small>Pendiente por asignar</small>
                </div>

            </div>

        </div>

        <div class="programacion-risk-legend">

            <h6>
                LEYENDA DE RIESGO
            </h6>

            <div class="programacion-risk-items">

                <div>
                    <span class="risk-dot bg-bajo"></span>
                    <strong>BAJO</strong>
                    <small>Riesgo bajo</small>
                </div>

                <div>
                    <span class="risk-dot bg-medio"></span>
                    <strong>MEDIO</strong>
                    <small>Riesgo medio</small>
                </div>

                <div>
                    <span class="risk-dot bg-alto"></span>
                    <strong>ALTO</strong>
                    <small>Riesgo alto</small>
                </div>

            </div>

        </div>

    </div>

</div>

<input type="hidden"
       id="url_estatus"
       value="{{ route('programacion.updatemonitoreoajax') }}">

<form method="post"
      id="programacion_delete_form"
      action="{{ route('programacion.deasactivarprogramacion') }}"
      enctype="multipart/form-data">

    @csrf

    <input type="hidden"
           name="id"
           id="id_programacion_delete"
           value="">

</form>

<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="model_add_incidencia">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border-secondary">

            <div class="modal-header border-secondary">

                <h5 class="modal-title text-gold">
                    Observaciones
                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal"
                        aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form action="{{ route('programacion.guardarobservacion') }}"
                      method="post"
                      id="submit_incidencia">

                    @csrf

                    <div class="form-group">

                        <label class="text-muted">
                            Observación
                        </label>

                        <textarea class="form-control custom-input"
                                  name="observacion"
                                  id="observacion"
                                  rows="4"></textarea>

                        <input type="hidden"
                               name="id"
                               id="id_programacion">

                    </div>

                </form>

            </div>

            <div class="modal-footer border-secondary">

                <button type="button"
                        class="btn btn-outline-custom"
                        data-dismiss="modal">
                    Cancelar
                </button>

                <button type="button"
                        id="send_incidencia"
                        class="btn btn-gold">
                    Guardar
                </button>

            </div>

        </div>

    </div>

</div>
@endsection 