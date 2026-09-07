@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=1.0.3') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/monitoreo/CatalogoMonitoreo.js?v=2.0.1') }}"></script>
@endpush

@section('title')
    Listado de monitoreo
@endsection

@section('content')
<div class="monitoreo-page">

    {{-- ENCABEZADO --}}
    <header class="monitoreo-page-header">
        <div>
            <span class="monitoreo-eyebrow">MONITOREO OPERATIVO</span>
            <h2 class="monitoreo-page-title">BITÁCORA DE SEGUIMIENTO</h2>
            <p class="monitoreo-page-subtitle">
                Seguimiento y control de los servicios programados.
            </p>
        </div>

        <div class="monitoreo-header-actions">
            <button type="button"
                    id="monitoreo_actualizar"
                    class="monitoreo-btn monitoreo-btn--primary">
                <i class="la la-refresh"></i>
                <span>ACTUALIZAR</span>
            </button>

            <button type="button"
                    id="monitoreo_exportar"
                    class="monitoreo-btn monitoreo-btn--secondary">
                <i class="la la-download"></i>
                <span>EXPORTAR</span>
            </button>

            <button type="button"
                    id="monitoreo_imprimir"
                    class="monitoreo-btn monitoreo-btn--secondary">
                <i class="la la-print"></i>
                <span>IMPRIMIR</span>
            </button>
        </div>
    </header>

    {{-- FILTROS --}}
    <section class="monitoreo-panel monitoreo-filter-panel">
        <div class="monitoreo-filter-grid">

            <div class="monitoreo-filter-field">
                <label class="monitoreo-label" for="monitoreo_filtro_servicio">
                    Servicio
                </label>

                <select id="monitoreo_filtro_servicio"
                        class="form-control monitoreo-input">
                    <option value="">Todos los servicios</option>

                    @foreach($monitoreo->sortBy('folio')->unique('folio') as $servicio)
                        <option value="{{ $servicio->folio }}">
                            {{ $servicio->folio }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="monitoreo-filter-field">
                <label class="monitoreo-label" for="monitoreo_filtro_estatus">
                    Estatus
                </label>

                <select id="monitoreo_filtro_estatus"
                        class="form-control monitoreo-input">
                    <option value="">Todos los estatus</option>

                    @foreach($estatus_programacion as $estatus)
                        <option value="{{ $estatus->id }}">
                            {{ $estatus->estatus_programacion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="monitoreo-filter-field monitoreo-filter-field--search">
                <label class="monitoreo-label" for="monitoreo_buscar">
                    Buscar coincidencia
                </label>

                <div class="monitoreo-search">
                    <i class="la la-search"></i>

                    <input type="text"
                           id="monitoreo_buscar"
                           class="form-control monitoreo-input"
                           placeholder="Folio, cliente, origen, destino, custodio..."
                           autocomplete="off">
                </div>
            </div>

            <div class="monitoreo-filter-actions">
                <button type="button"
                        id="monitoreo_limpiar_filtros"
                        class="monitoreo-btn monitoreo-btn--secondary">
                    <i class="la la-undo"></i>
                    Limpiar filtros
                </button>
            </div>

        </div>
    </section>

    {{-- TABLA --}}
    <section class="monitoreo-panel monitoreo-services-panel">

        <div class="monitoreo-panel-header">
            <div>
                <span class="monitoreo-eyebrow">SERVICIOS ACTIVOS</span>

                <h6>
                    SERVICIOS PROGRAMADOS
                    <span class="monitoreo-counter" id="monitoreo_total">
                        {{ $monitoreo->count() }}
                    </span>
                </h6>
            </div>

            <div class="monitoreo-panel-header__legend">
                <span class="monitoreo-live-dot"></span>
                Actualización de estatus habilitada
            </div>
        </div>

        <div class="monitoreo-table-wrapper">
            <table class="monitoreo-table"
                   id="kdatatable_usuarios2">

                <thead>
                    <tr>
                        <th class="monitoreo-col-bitacora">
                            Bitácora
                        </th>

                        <th class="monitoreo-col-folio">
                            Folio
                        </th>

                        <th class="monitoreo-col-estatus">
                            Estatus
                        </th>

                        <th class="monitoreo-col-cliente">
                            Cliente
                        </th>

                        <th class="monitoreo-col-fecha">
                            Fecha y hora servicio
                        </th>

                        <th class="monitoreo-col-tipo">
                            Tipo de servicio
                        </th>

                        <th class="monitoreo-col-ruta">
                            Domicilio origen
                        </th>

                        <th class="monitoreo-col-ruta">
                            Domicilio destino
                        </th>

                        <th class="monitoreo-col-custodio">
                            Custodio
                        </th>

                        <th class="monitoreo-col-acompanantes">
                            Armados y acompañantes
                        </th>

                        <th class="monitoreo-col-fecha-operativa">
                            Llegada trayecto
                        </th>

                        <th class="monitoreo-col-fecha-operativa">
                            Llegada a destino
                        </th>

                        <th class="monitoreo-col-fecha-operativa">
                            Finalización
                        </th>

                        <th class="monitoreo-col-acciones text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($monitoreo as $unid)
                        <tr data-monitoreo-row
                            data-folio="{{ $unid->folio }}"
                            data-status-id="{{ $unid->programacion_estatus_id }}">

                            <td class="monitoreo-id">
                                <span class="monitoreo-bitacora-number">
                                    {{ $unid->id }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('monitoreo.verprogramacionmon', $unid->id) }}"
                                   class="monitoreo-folio">
                                    {{ $unid->folio }}
                                </a>
                            </td>

                            <td>
                                <select class="form-control monitoreo-status-select"
                                        id="programacion_id_{{ $unid->id }}"
                                        name="programacion_id"
                                        data-role="estatus-programacion"
                                        data-programacion="{{ $unid->id }}">

                                    @foreach($estatus_programacion as $tp)
                                        <option value="{{ $tp->id }}"
                                                @selected($unid->programacion_estatus_id == $tp->id)>
                                            {{ $tp->estatus_programacion }}
                                        </option>
                                    @endforeach

                                </select>
                            </td>

                            <td class="monitoreo-client">
                                {{ $unid->nombre_cliente }}
                            </td>

                            <td class="monitoreo-date">
                                {{ date('d/m/Y h:i A', strtotime($unid->fecha_servicio)) }}
                            </td>

                             <td>
                                <span class="monitoreo-service-type">
                                    {{ $unid->tipo_servicio == 0 ? 'Foráneo' : 'Local' }}
                                </span>
                            </td>

                            <td class="monitoreo-route"
                                title="{{ $unid->dom_origen }}">
                                {{ $unid->dom_origen }}
                            </td>

                            <td class="monitoreo-route"
                                title="{{ $unid->dom_destino }}">
                                {{ $unid->dom_destino }}
                            </td>

                            <td>
                                <div class="monitoreo-custodio">
                                    <span class="monitoreo-custodio-avatar">
                                        {{ substr($unid->custodio->nombre_custodio ?? 'S', 0, 1) }}
                                    </span>

                                    <span>
                                        {{ $unid->custodio->nombre_custodio ?? 'Sin asignar' }}
                                        {{ $unid->custodio->ap_paterno ?? '' }}
                                    </span>
                                </div>
                            </td>

                            <td class="monitoreo-muted">
                                <span class="monitoreo-acompanantes-value">
                                    {{ $unid->acompañante ?? '-' }}
                                </span>
                            </td>

                            <td class="monitoreo-date monitoreo-operational-date">
                                {{ $unid->fechahora_inicio_trayecto == '' || $unid->fechahora_inicio_trayecto == NULL ? '-' : date('d/m/Y h:i A', strtotime($unid->fechahora_inicio_trayecto)) }}
                            </td>

                            <td class="monitoreo-date monitoreo-operational-date">
                                {{ $unid->fechahora_llegado_destino == '' || $unid->fechahora_llegado_destino == NULL ? '-' : date('d/m/Y h:i A', strtotime($unid->fechahora_llegado_destino)) }}
                            </td>

                            <td class="monitoreo-date monitoreo-operational-date">
                                {{ $unid->fechahora_finalizacion == '' || $unid->fechahora_finalizacion == NULL ? '-' : date('d/m/Y h:i A', strtotime($unid->fechahora_finalizacion)) }}
                            </td>

                            <td>
                                <div class="monitoreo-row-actions">

                                    <a href="{{ route('monitoreo.verprogramacionmon', $unid->id) }}"
                                       class="monitoreo-action"
                                       title="Ver programación">
                                        <i class="flaticon-eye"></i>
                                    </a>

                                    <a href="{{ route('monitoreo.moduloestadias', $unid->id) }}"
                                       class="monitoreo-action"
                                       title="Generales transportes">
                                        <i class="flaticon-presentation-1"></i>
                                    </a>

                                    <button type="button"
                                            class="monitoreo-action js-add-incidencia"
                                            data-programacion="{{ $unid->id }}"
                                            data-toggle="modal"
                                            data-target="#model_add_incidencia"
                                            title="Agregar incidencia">
                                        <i class="flaticon-notepad"></i>
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div id="monitoreo_sin_resultados"
                 class="monitoreo-empty">
                <i class="la la-search"></i>
                <strong>Sin coincidencias</strong>
                <span>No encontramos servicios con los filtros seleccionados.</span>
            </div>
        </div>

        <div class="monitoreo-table-footer">
            <div id="monitoreo_info"
                 class="monitoreo-table-info">
            </div>

            <div id="monitoreo_paginador"
                 class="monitoreo-pagination">
            </div>
        </div>

    </section>

</div>

<input type="hidden"
       id="url_estatus"
       value="{{ route('monitoreo.updateestatusajax') }}">

<input type="hidden"
       id="datatable_i18n"
       value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

<div class="modal fade monitoreo-modal" id="model_add_incidencia" tabindex="-1" role="dialog" aria-labelledby="tituloModalIncidencia" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered monitoreo-modal-dialog" role="document">
        <div class="modal-content monitoreo-modal-content">
            <div class="modal-header monitoreo-modal-header">
                <div class="monitoreo-modal-heading">
                    <span class="monitoreo-modal-icon">
                        <i class="flaticon-warning"></i>
                    </span>

                    <div>
                        <span class="monitoreo-eyebrow">
                            SEGUIMIENTO OPERATIVO
                        </span>

                        <h5 class="modal-title"
                            id="tituloModalIncidencia">
                            Registrar incidencia
                        </h5>
                    </div>
                </div>

                <button type="button" class="monitoreo-modal-close" data-dismiss="modal" aria-label="Cerrar">
                    <i class="la la-times"></i>
                </button>

            </div>

            <div class="modal-body monitoreo-modal-body">

                <form action="{{ route('monitoreo.guardarincidencia') }}" method="post"id="submit_incidencia">

                    @csrf
                    <div class="monitoreo-modal-info">
                        <span class="monitoreo-modal-info__icon">
                            <i class="la la-info-circle"></i>
                        </span>
                        <p>
                            Registra cualquier situación relevante detectada
                            durante el seguimiento de este servicio.
                        </p>
                    </div>

                    <div class="form-group monitoreo-modal-field">
                        <label class="monitoreo-label" for="incidencia">
                            Descripción de la incidencia *
                        </label>

                        <textarea class="form-control monitoreo-modal-textarea" name="incidencia" id="incidencia" rows="5"
                                  placeholder="Describe brevemente la incidencia detectada..."></textarea>

                        <div class="monitoreo-modal-field-help">
                            Procura incluir información útil para el seguimiento operativo.
                        </div>

                        <input type="hidden" name="id" id="id_programacion">
                    </div>

                </form>

            </div>

            <div class="modal-footer monitoreo-modal-footer">
                <button type="button" class="monitoreo-btn monitoreo-btn--secondary" data-dismiss="modal">
                    <i class="la la-times"></i>
                    Cancelar
                </button>

                <button type="button"  id="send_incidencia" class="monitoreo-btn monitoreo-btn--primary">
                    <i class="la la-plus"></i>
                    Guardar incidencia
                </button>
            </div>
        </div>
    </div>
</div>

@endsection