@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=1.0.1') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin="" />
@endpush

@push('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script src="{{ asset('js/monitoreo/CatalogoMonitoreo.js?v=2.0.2') }}"></script>
    <script src="{{ asset('js/monitoreo/InfoProEstatus.js?v=1.0.3') }}"></script>
@endpush

@section('title')
    Información del servicio
@endsection

@section('content')

@php
    $clienteActual = $cliente->firstWhere('id', $programacion->cliente_id);
    $custodioActual = $custodio->firstWhere('id', $programacion->custodio_id);
    $estatusActual = $estatus_programacion->firstWhere('id', $programacion->programacion_estatus_id);
    $tarifarioActual = $tarifario->firstWhere('id', $programacion->tarifario_id);

    $nombreCustodio = $custodioActual
        ? trim(
            $custodioActual->nombre_custodio . ' ' .
            $custodioActual->ap_paterno . ' ' .
            $custodioActual->ap_materno
        )
        : 'Sin custodio asignado';

    $inicialCustodio = $custodioActual
        ? strtoupper(substr($custodioActual->nombre_custodio, 0, 1))
        : 'S';

    $nombreCliente = $clienteActual
        ? $clienteActual->nombre_cliente
        : 'Sin cliente';

    $razonSocial = $clienteActual
        ? $clienteActual->razon_social
        : '';

    $estatusNombre = $estatusActual
        ? $estatusActual->estatus_programacion
        : 'Sin estatus';

    $totalActividad = $incidencias->count() + $observaciones->count();
@endphp

<div class="monitoreo-detail-page">

    <header class="monitoreo-detail-header">

        <div>
            <span class="monitoreo-eyebrow">
                SEGUIMIENTO DEL SERVICIO
            </span>

            <h2 class="monitoreo-page-title">
                {{ $programacion->folio }}
            </h2>

            <p class="monitoreo-page-subtitle">
                Consulta la información operativa y el seguimiento del servicio.
            </p>
        </div>

        <a href="{{ route('monitoreo.listamonitoreo') }}"
           class="monitoreo-btn monitoreo-btn--secondary">

            <i class="flaticon2-back"></i>
            Regresar

        </a>

    </header>

    <div class="monitoreo-detail-grid">

        <section class="monitoreo-panel monitoreo-detail-card">

            <div class="monitoreo-panel-header">
                <div>
                    <span class="monitoreo-eyebrow">
                        INFORMACIÓN GENERAL
                    </span>

                    <h6>
                        DETALLES DEL SERVICIO
                    </h6>
                </div>

                <i class="la la-file-text monitoreo-header-icon"></i>
            </div>

            <div class="monitoreo-detail-body">

                <div class="monitoreo-detail-list">

                    <div>
                        <span>Cliente</span>

                        <strong>
                            {{ $nombreCliente }}
                        </strong>

                        @if($razonSocial)
                            <small>
                                {{ $razonSocial }}
                            </small>
                        @endif
                    </div>

                    <div>
                        <span>Folio</span>

                        <strong class="text-gold">
                            {{ $programacion->folio }}
                        </strong>
                    </div>

                    <div>
                        <span>Tipo de servicio</span>

                        <strong>
                            {{ $programacion->tipo_servicio == 0 ? 'Foráneo' : 'Local' }}
                        </strong>
                    </div>

                    <div>
                        <span>Fecha y hora</span>

                        <strong>
                            {{ date('d/m/Y H:i', strtotime($programacion->fecha_servicio)) }}
                        </strong>
                    </div>

                </div>

                <div class="monitoreo-route-summary">

                    <div class="monitoreo-route-point">
                        <span class="monitoreo-route-marker monitoreo-route-marker--origin"></span>

                        <div>
                            <small>ORIGEN</small>
                            <strong>{{ $programacion->dom_origen }}</strong>
                        </div>
                    </div>

                    <span class="monitoreo-route-line"></span>

                    <div class="monitoreo-route-point">
                        <span class="monitoreo-route-marker monitoreo-route-marker--destination"></span>

                        <div>
                            <small>DESTINO</small>
                            <strong>{{ $programacion->dom_destino }}</strong>
                        </div>
                    </div>

                </div>

                @if($tarifarioActual)
                    <div class="monitoreo-detail-note">
                        <i class="la la-map-signs"></i>

                        <div>
                            <span>Tarifario asociado</span>
                            <strong>
                                {{ $tarifarioActual->origen }} →
                                {{ $tarifarioActual->destino }}
                            </strong>
                        </div>
                    </div>
                @endif

                @if(!empty($programacion->observaciones))
                    <div class="monitoreo-detail-note">
                        <i class="la la-sticky-note"></i>

                        <div>
                            <span>Observaciones</span>
                            <strong>
                                {{ $programacion->observaciones }}
                            </strong>
                        </div>
                    </div>
                @endif

            </div>

        </section>


        {{-- MAPA --}}
        <section class="monitoreo-panel monitoreo-map-card"
                 id="map-container-fullscreen">

            <div class="monitoreo-panel-header">

                <div>
                    <span class="monitoreo-eyebrow">
                        REFERENCIA GEOGRÁFICA
                    </span>

                    <h6>
                        ORIGEN Y DESTINO
                    </h6>
                </div>

                <div class="monitoreo-map-header-actions">

                    <span id="map-status"
                          class="monitoreo-map-status">
                        <span class="monitoreo-live-dot"></span>
                        Localizando...
                    </span>

                    <button type="button"
                            id="btnMapFullscreen"
                            class="monitoreo-map-fullscreen"
                            title="Expandir mapa">

                        <i class="la la-expand"></i>

                    </button>

                </div>

            </div>

            <div class="monitoreo-map-body">

                <div id="map-monitoring"
                     data-origen="{{ $programacion->dom_origen }}"
                     data-destino="{{ $programacion->dom_destino }}">
                </div>

                <div class="monitoreo-map-footer">

                    <div>
                        <span class="monitoreo-route-marker monitoreo-route-marker--origin"></span>
                        Origen
                    </div>

                    <div>
                        <span class="monitoreo-route-marker monitoreo-route-marker--destination"></span>
                        Destino
                    </div>

                    <div class="monitoreo-map-distance">
                        <i class="la la-road"></i>

                        <span id="map-distance">
                            Calculando distancia aproximada...
                        </span>
                    </div>

                </div>

            </div>

        </section>


        {{-- ESTATUS --}}
        <section class="monitoreo-panel monitoreo-status-card">

            <div class="monitoreo-panel-header">

                <div>
                    <span class="monitoreo-eyebrow">
                        ESTADO ACTUAL
                    </span>

                    <h6>
                        ESTATUS DEL SERVICIO
                    </h6>
                </div>

                <span class="monitoreo-status-indicator"></span>

            </div>

            <div class="monitoreo-status-body">

                <div class="monitoreo-current-status">
                    <span class="monitoreo-current-status__icon">
                        <i class="la la-truck"></i>
                    </span>

                    <div>
                        <small>ESTATUS ACTUAL</small>
                        <strong>{{ $estatusNombre }}</strong>
                    </div>
                </div>

                <div class="monitoreo-status-info">

                    <div>
                        <span>Programado para</span>

                        <strong>
                            {{ date('d/m/Y', strtotime($programacion->fecha_servicio)) }}
                        </strong>
                    </div>

                    <div>
                        <span>Hora</span>

                        <strong>
                            {{ date('H:i', strtotime($programacion->fecha_servicio)) }}
                        </strong>
                    </div>

                </div>

                <form action="{{ route('monitoreo.updateestatus') }}"
                      method="post"
                      id="submit_estatus"
                      enctype="multipart/form-data">

                    @csrf

                    <input type="hidden"
                           name="id_programacion"
                           value="{{ $id_programacion }}">

                    <div class="form-group">
                        <label class="monitoreo-label"
                               for="estatus_id">
                            Cambiar estatus
                        </label>

                        <select class="form-control monitoreo-input"
                                id="estatus_id"
                                name="estatus_id"
                                required>

                            <option value="">
                                Selecciona el estatus
                            </option>

                            @foreach($estatus_programacion as $tp)
                                <option value="{{ $tp->id }}"
                                        @selected($programacion->programacion_estatus_id == $tp->id)>
                                    {{ $tp->estatus_programacion }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <button type="button"
                            id="btnupdatestatus"
                            class="monitoreo-btn monitoreo-btn--primary monitoreo-status-save">

                        <i class="la la-save"></i>
                        Guardar estatus

                    </button>

                </form>

            </div>

        </section>

    </div>

    <div class="monitoreo-detail-secondary-grid">

        <section class="monitoreo-panel monitoreo-custodio-card">

            <div class="monitoreo-panel-header">

                <div>
                    <span class="monitoreo-eyebrow">
                        PERSONAL
                    </span>

                    <h6>
                        CUSTODIO ASIGNADO
                    </h6>
                </div>

            </div>

            <div class="monitoreo-custodio-body">

                <div class="monitoreo-custodio-profile">

                    <span class="monitoreo-custodio-profile__avatar">
                        {{ $inicialCustodio }}
                    </span>

                    <div>
                        <strong>{{ $nombreCustodio }}</strong>

                        @if($custodioActual)
                            <small>
                                ID: {{ $custodioActual->id }}
                            </small>
                        @endif
                    </div>

                </div>

                <span class="monitoreo-connected-badge">
                    <span></span>
                    ASIGNADO
                </span>

            </div>

        </section>

        <section class="monitoreo-panel monitoreo-companions-card">

            <div class="monitoreo-panel-header">

                <div>
                    <span class="monitoreo-eyebrow">
                        EQUIPO OPERATIVO
                    </span>

                    <h6>
                        ACOMPAÑANTES
                        <span class="monitoreo-counter">
                            {{ $acompanantes_pro->count() }}
                        </span>
                    </h6>
                </div>

            </div>

            <div class="monitoreo-companions-body">

                @forelse($acompanantes_pro as $documento)

                    <div class="monitoreo-companion">

                        <span class="monitoreo-companion__avatar">
                            {{ strtoupper(substr($documento->custodio->nombre_custodio ?? 'C', 0, 1)) }}
                        </span>

                        <div>
                            <strong>
                                {{ $documento->custodio->nombre_custodio ?? '' }}
                                {{ $documento->custodio->ap_paterno ?? '' }}
                                {{ $documento->custodio->ap_materno ?? '' }}
                            </strong>

                            <small>
                                Custodio acompañante
                            </small>
                        </div>

                    </div>

                @empty

                    <div class="monitoreo-empty-inline">
                        <i class="la la-user"></i>

                        <span>
                            Este servicio no tiene acompañantes registrados.
                        </span>
                    </div>

                @endforelse

            </div>

        </section>

    </div>

    <section class="monitoreo-panel monitoreo-activity-card">

        <div class="monitoreo-panel-header">

            <div>
                <span class="monitoreo-eyebrow">
                    HISTORIAL OPERATIVO
                </span>

                <h6>
                    BITÁCORA DEL SERVICIO
                    <span class="monitoreo-counter">
                        {{ $totalActividad }}
                    </span>
                </h6>
            </div>

        </div>

        <div class="monitoreo-timeline">

            @foreach($incidencias->sortByDesc('created_at') as $unid)

                <div class="monitoreo-timeline-item">

                    <span class="monitoreo-timeline-dot monitoreo-timeline-dot--alert"></span>

                    <div class="monitoreo-timeline-time">
                        {{ date('d/m/Y H:i', strtotime($unid->created_at)) }}
                    </div>

                    <div class="monitoreo-timeline-content">

                        <span class="monitoreo-timeline-type monitoreo-timeline-type--alert">
                            INCIDENCIA
                        </span>

                        <strong>
                            {{ $unid->incidencia }}
                        </strong>

                        <small>
                            Registrado por:
                            {{ $unid->userCreated->name }}
                        </small>

                    </div>

                </div>

            @endforeach


            @foreach($observaciones->sortByDesc('created_at') as $unid)

                <div class="monitoreo-timeline-item">

                    <span class="monitoreo-timeline-dot"></span>

                    <div class="monitoreo-timeline-time">
                        {{ date('d/m/Y H:i', strtotime($unid->created_at)) }}
                    </div>

                    <div class="monitoreo-timeline-content">

                        <span class="monitoreo-timeline-type">
                            OBSERVACIÓN
                        </span>

                        <strong>
                            {{ $unid->observacion }}
                        </strong>

                        <small>
                            Registrado por:
                            {{ $unid->userCreated->name }}
                        </small>

                    </div>

                </div>

            @endforeach


            @if($totalActividad == 0)

                <div class="monitoreo-empty-inline monitoreo-empty-inline--center">
                    <i class="la la-history"></i>

                    <span>
                        Aún no hay actividad registrada para este servicio.
                    </span>
                </div>

            @endif

        </div>

    </section>


    {{-- TABLAS DE CONTROL --}}
    <div class="monitoreo-records-grid">

        {{-- OBSERVACIONES --}}
        <section class="monitoreo-panel">

            <div class="monitoreo-panel-header">

                <div>
                    <span class="monitoreo-eyebrow">
                        CONTROL
                    </span>

                    <h6>
                        OBSERVACIONES
                    </h6>
                </div>

            </div>

            <div class="monitoreo-record-table-wrapper">

                <table class="monitoreo-record-table"
                       id="kdatatable_observaciones">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Observación</th>
                            <th>Fecha y hora</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($observaciones as $unid)

                            <tr>
                                <td>{{ $unid->id }}</td>

                                <td>
                                    {{ $unid->observacion }}
                                </td>

                                <td>
                                    {{ date('d/m/Y h:i A', strtotime($unid->created_at)) }}
                                </td>

                                <td>
                                    {{ $unid->userCreated->name }}
                                </td>
                            </tr>

                        @endforeach
                    </tbody>

                </table>

            </div>

        </section>


        {{-- INCIDENCIAS --}}
        <section class="monitoreo-panel">

            <div class="monitoreo-panel-header">

                <div>
                    <span class="monitoreo-eyebrow">
                        SEGUIMIENTO
                    </span>

                    <h6>
                        INCIDENCIAS
                    </h6>
                </div>

            </div>

            <div class="monitoreo-record-table-wrapper">

                <table class="monitoreo-record-table"
                       id="kdatatable_incidenciass">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Incidencia</th>
                            <th>Fecha y hora</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($incidencias as $unid)

                            <tr>
                                <td>{{ $unid->id }}</td>

                                <td>
                                    {{ $unid->incidencia }}
                                </td>

                                <td>
                                    {{ date('d/m/Y h:i A', strtotime($unid->created_at)) }}
                                </td>

                                <td>
                                    {{ $unid->userCreated->name }}
                                </td>
                            </tr>

                        @endforeach
                    </tbody>

                </table>

            </div>

        </section>

    </div>

</div>

<input type="hidden"
       id="datatable_i18n"
       value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection