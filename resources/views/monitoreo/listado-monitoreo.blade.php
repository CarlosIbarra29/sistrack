@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/monitoreo/CatalogoMonitoreo.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

@section('title')
    Listado de monitoreo
@endsection

@section('content')

<div class="container-fluid bg-sisprotec p-4">

    
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="main-title-custom text-uppercase m-0">Bitácora de Seguimiento</h3>
            <span class="text-muted-custom font-size-sm">Seguimiento en tiempo real del servicio de custodia.</span>
        </div>
    </div>

    
    <div class="card-monitoring p-3 mb-4">
        <div class="form-row align-items-center">
            <div class="col-md-3 mb-2 mb-md-0">
                <label class="text-muted-custom font-size-xs m-0 d-block">Servicio</label>
                <div class="d-flex align-items-center mt-1">
                    <select class="form-control filter-input-custom font-weight-bold mr-2" style="width: 60%;">
                        <option>CUST-2026-0428-0017</option>
                    </select>
                    <span class="badge badge-en-ruta">EN RUTA</span>
                </div>
            </div>
            <div class="col-md-2 mb-2 mb-md-0">
                <label class="text-muted-custom font-size-xs m-0 d-block">Fecha</label>
                <input type="date" id="filtro_fecha" class="form-control filter-input-custom w-100 mt-1" value="2026-04-28">
            </div>
            <div class="col-md-2 mb-2 mb-md-0">
                <label class="text-muted-custom font-size-xs m-0 d-block">Estatus</label>
                <select class="form-control filter-input-custom w-100 mt-1">
                    <option>Todos</option>
                </select>
            </div>
            <div class="col-md-5 text-md-right mt-3 mt-md-0">
                <button class="btn btn-sm btn-warning font-weight-bold px-3 text-dark" style="background-color: #eab308;" onclick="window.location.reload();"><i class="la la-refresh"></i> ACTUALIZAR</button>
                <button class="btn btn-sm btn-outline-secondary font-weight-bold px-3 ml-1 text-white border-secondary"><i class="la la-download"></i> EXPORTAR</button>
                <button class="btn btn-sm btn-outline-secondary font-weight-bold px-3 ml-1 text-white border-secondary"><i class="la la-print"></i> IMPRIMIR</button>
            </div>
        </div>
    </div>

    
    <div class="row items-stretch">
        
        
        <div class="col-xl-3 col-lg-4 d-flex flex-column">
            <div class="card-monitoring flex-grow-1">
                <div class="card-monitoring-header">
                    <span class="text-gold font-weight-bold text-uppercase">Detalles del Servicio</span>
                </div>
                <div class="card-body p-3">
                    <div class="row mb-2">
                        <div class="col-5 text-muted-custom">Cliente</div>
                        <div class="col-7 font-weight-bold">TYASA</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted-custom">No. Embarque</div>
                        <div class="col-7 text-white">EMB-78291</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted-custom">Tipo de servicio</div>
                        <div class="col-7 text-white">Custodia</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted-custom">Origen</div>
                        <div class="col-7 text-white-50">CDMX - Centro de Distribución</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 text-muted-custom">Destino</div>
                        <div class="col-7 text-white-50">Puebla - Planta Industrial</div>
                    </div>
                    
                    <div class="form-row border-top border-dark pt-3 mb-3">
                        <div class="col-6">
                            <span class="text-muted-custom font-size-xs d-block">Fecha salida</span>
                            <span class="text-white font-weight-bold">28/04/2026</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted-custom font-size-xs d-block">Hora salida</span>
                            <span class="text-white font-weight-bold">08:00</span>
                        </div>
                    </div>

                    <span class="text-gold font-weight-bold d-block mb-2 font-size-xs text-uppercase">Custodio asignado</span>
                    <div class="d-flex align-items-center p-2 rounded mb-3" style="background-color: #090f1d; border: 1px solid #1e2d4a;">
                        <div class="symbol symbol-35 symbol-circle mr-3">
                            <span class="symbol-label bg-warning text-dark font-weight-bold">JP</span>
                        </div>
                        <div>
                            <span class="font-weight-bold text-white d-block">Juan Pérez García</span>
                            <small class="text-muted-custom">ID: CUST-015</small>
                        </div>
                    </div>

                    <span class="text-muted-custom d-block font-size-xs">Unidad asignada</span>
                    <span class="text-white font-weight-bold d-block mb-2">U-12 <span class="font-weight-normal text-muted-custom">| Nissan NP300 Blanca</span></span>

                    <span class="text-muted-custom d-block font-size-xs">Nivel de riesgo</span>
                    <span class="text-white font-weight-bold d-block mb-3"><i class="fa fa-circle text-warning font-size-xs mr-1"></i> MEDIO</span>

                    <span class="text-muted-custom d-block font-size-xs">Observaciones</span>
                    <p class="text-white-50 font-size-xs p-2 rounded border" style="background-color: #090f1d; border-color: #1e2d4a !important;">
                        Mercancía sensible. Mantener comunicación cada 45 min.
                    </p>
                </div>
            </div>
        </div>

        
        <div class="col-xl-6 col-lg-8 d-flex flex-column">
            <!-- Mapa -->
            <div class="card-monitoring map-card-height mb-3" id="map-container-fullscreen">
                <div class="card-monitoring-header d-flex justify-content-between align-items-center">
                    <span class="text-gold font-weight-bold text-uppercase">Ubicación en Tiempo Real</span>
                    <span class="badge badge-gps"><i class="fa fa-map-marker mr-1"></i> GPS ACTIVO</span>
                </div>
                <div class="p-2 position-relative" style="height: calc(100% - 49px);">
                    <div class="map-wrapper" style="height: 100%;">
                        <button class="btn-map-fullscreen" title="Expandir mapa" onclick="toggleMapFullscreen();">
                            <svg viewBox="0 0 24 24">
                                <polyline points="10 4 4 4 4 10"></polyline>
                                <line x1="4" y1="4" x2="11" y2="11"></line>
                                <polyline points="14 20 20 20 20 14"></polyline>
                                <line x1="20" y1="20" x2="13" y2="13"></line>
                            </svg>
                        </button>
                        <div id="map-monitoring"></div>
                    </div>
                </div>
            </div>

                        <div class="card-monitoring flex-grow-1">
                <div class="card-monitoring-header d-flex justify-content-between align-items-center">
                    <span class="text-gold font-weight-bold text-uppercase">Bitácora de Eventos</span>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-events text-white mb-1">
                        <thead>
                            <tr>
                                <th>Hora</th>
                                <th>Tipo de evento</th>
                                <th>Descripción</th>
                                <th>Ubicación</th>
                                <th>Registrado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-muted-custom">11:15</td>
                                <td><span class="text-warning font-weight-bold"><i class="fa fa-exclamation-triangle mr-1"></i> Parada no programada</span></td>
                                <td class="text-white-50">Parada no programada detectada</td>
                                <td>Km 62+400</td>
                                <td class="text-muted-custom">Sistema GPS</td>
                            </tr>
                            <tr>
                                <td class="text-muted-custom">10:30</td>
                                <td><span class="text-steel-blue font-weight-bold"><i class="fa fa-info-circle mr-1"></i> Checkpoint</span></td>
                                <td class="text-white-50">Checkpoint alcanzado correctamente</td>
                                <td>Km 85+300</td>
                                <td class="text-muted-custom">Sistema GPS</td>
                            </tr>
                            <tr>
                                <td class="text-muted-custom">09:45</td>
                                <td><span class="text-custom-emerald font-weight-bold"><i class="fa fa-check-circle mr-1"></i> Comunicación</span></td>
                                <td class="text-white-50">Comunicación con custodio realizada</td>
                                <td>Km 45+200</td>
                                <td class="text-muted-custom">Centro de Monitoreo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-lg-12 d-flex flex-column">
            
            <div class="card-monitoring map-card-height mb-3 d-flex flex-column">
                <div class="card-monitoring-header">
                    <span class="text-gold font-weight-bold text-uppercase">Estatus del Servicio</span>
                </div>
                <div class="card-body p-0 d-flex flex-column flex-grow-1">
                    <div class="d-flex flex-column h-100">
                        <div class="status-item-custom justify-content-between">
                            <div class="d-flex align-items-start">
                                <span class="text-custom-emerald mr-3 mt-1"><i class="la la-truck font-size-h4"></i></span>
                                <div>
                                    <span class="text-custom-emerald font-weight-bold font-size-sm d-block">EN RUTA</span>
                                    <small class="text-muted-custom d-block mt-1">Servicio en curso de custodia activa</small>
                                </div>
                            </div>
                        </div>

                        <div class="status-item-custom justify-content-between">
                            <div class="d-flex align-items-start">
                                <span class="text-steel-blue mr-3 mt-1"><i class="la la-clock-o font-size-h4"></i></span>
                                <div>
                                    <span class="text-white font-weight-bold font-size-sm d-block">03:32:45 &nbsp; Tiempo Transcurrido</span>
                                    <small class="text-muted-custom d-block mt-1">Inicio: 28/04/2026 08:00</small>
                                    <small class="text-muted-custom d-block">Estimado de llegada: 10:45</small>
                                </div>
                            </div>
                        </div>

                        <div class="status-item-custom justify-content-between">
                            <div class="d-flex align-items-start w-100 pr-3">
                                <span class="text-warning mr-3 mt-1"><i class="la la-map-signs font-size-h4"></i></span>
                                <div class="w-100">
                                    <span class="text-white font-weight-bold font-size-sm d-block">68% &nbsp; Progreso de Ruta</span>
                                    <div class="progress progress-custom mt-2">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 68%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                        <div class="card-monitoring flex-grow-1 d-flex flex-column mb-3">
                <div class="card-monitoring-header d-flex justify-content-between align-items-center">
                    <span class="text-gold font-weight-bold text-uppercase">Alertas</span>
                    <a href="#" class="font-size-xs text-gold">Ver todas</a>
                </div>
                <div class="card-body p-0 d-flex flex-column flex-grow-1">
                    <div class="alert-container-flex flex-grow-1">
                        <div class="p-3 alert-item-custom justify-content-between">
                            <div class="d-flex align-items-start">
                                <span class="text-warning mr-3 mt-1"><i class="fa fa-exclamation-triangle font-size-h6"></i></span>
                                <div>
                                    <span class="text-white font-weight-bold font-size-sm d-block">11:15 &nbsp; Parada no programada</span>
                                    <small class="text-muted-custom d-block mt-1">Duración: 00:05:12 | Km 62+400</small>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 alert-item-custom justify-content-between">
                            <div class="d-flex align-items-start">
                                <span class="text-steel-blue mr-3 mt-1"><i class="fa fa-info-circle font-size-h6"></i></span>
                                <div>
                                    <span class="text-white font-weight-bold font-size-sm d-block">10:30 &nbsp; Checkpoint Alcanzado</span>
                                    <small class="text-muted-custom d-block mt-1">San Martín Texmelucan | Km 85+300</small>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 alert-item-custom justify-content-between">
                            <div class="d-flex align-items-start">
                                <span class="text-custom-emerald mr-3 mt-1"><i class="fa fa-check-circle font-size-h6"></i></span>
                                <div>
                                    <span class="text-white font-weight-bold font-size-sm d-block">09:10 &nbsp; Servicio Iniciado</span>
                                    <small class="text-muted-custom d-block mt-1">CDMX - Centro de Distribución</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        
        <div class="col-md-6 d-flex">
            <div class="card-monitoring w-100 p-2">
                <div class="card-monitoring-header">
                    <span class="text-gold font-weight-bold text-uppercase">Comunicación con Custodio</span>
                </div>
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="row w-100 align-items-center">
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="symbol symbol-50 symbol-circle mr-3">
                                <span class="symbol-label bg-secondary text-white font-weight-bold">JP</span>
                            </div>
                            <div>
                                <h5 class="m-0 font-weight-bold text-white">Juan Pérez García</h5>
                                <small class="text-muted-custom d-block mb-2">ID: CUST-015</small>
                                <span class="badge badge-en-ruta">CONECTADO</span>
                            </div>
                        </div>
                        <div class="col-lg-6 text-lg-right mt-3 mt-lg-0">
                            <div class="d-inline-block text-center mr-3">
                                <a href="#" class="btn-circle-action"><i class="la la-phone font-size-h4"></i></a>
                                <small class="text-muted-custom d-block mt-1">Llamada</small>
                            </div>
                            <div class="d-inline-block text-center mr-3">
                                <a href="#" class="btn-circle-action"><i class="la la-comments font-size-h4"></i></a>
                                <small class="text-muted-custom d-block mt-1">Mensaje</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="col-md-6 d-flex">
            <div class="card-monitoring w-100 p-2">
                <div class="card-monitoring-header">
                    <span class="text-gold font-weight-bold text-uppercase">Documentos del Servicio</span>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-sm-4 col-6 mb-2">
                            <div class="doc-box text-center">
                                <i class="la la-file-pdf text-danger font-size-h2 mb-1"></i>
                                <span class="d-block font-size-xs text-white text-truncate font-weight-bold">Orden de Serv.</span>
                                <a href="#" class="font-size-xs text-gold mt-1">Descargar</a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 mb-2">
                            <div class="doc-box text-center">
                                <i class="la la-file-pdf text-danger font-size-h2 mb-1"></i>
                                <span class="d-block font-size-xs text-white text-truncate font-weight-bold">Carta Porte</span>
                                <a href="#" class="font-size-xs text-gold mt-1">Descargar</a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12 mb-2">
                            <div class="doc-box text-center">
                                <i class="la la-file-text text-success font-size-h2 mb-1"></i>
                                <span class="d-block font-size-xs text-white text-truncate font-weight-bold">Hoja de Ruta</span>
                                <a href="#" class="font-size-xs text-gold mt-1">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <div class="row mt-4">
        <div class="col-12">
            <div class="card-monitoring p-4">
                <h5 class="text-white mb-4 font-weight-bold text-uppercase d-flex align-items-center">
                    <i class="flaticon2-file text-warning mr-3 font-size-lg"></i>
                    SERVICIOS PROGRAMADOS ({{ $monitoreo->count() }})
                </h5>
                <div class="table-responsive">
                    <table class="table text-white font-size-sm m-0" id="kdatatable_usuarios2">
                        <thead>
                            <tr class="text-gold border-bottom border-dark text-uppercase font-size-xs">
                                <th class="py-3" style="width: 50px;">No.</th>
                                <th class="py-3 text-nowrap">Folio</th>
                                <th class="py-3">Cliente</th>
                                <th class="py-3">Domicilio origen</th>
                                <th class="py-3">Domicilio destino</th>
                                <th class="py-3 text-nowrap">Fecha y Hora</th>
                                <th class="py-3">Custodio</th>
                                <th class="py-3 text-nowrap">Tipo de servicio</th>
                                <th class="py-3" style="min-width: 150px;">Estatus</th>
                                <th class="py-3 text-nowrap">Monitoreo</th>
                                <th class="py-3 text-center" style="width: 140px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($monitoreo as $unid)
                                <tr class="border-bottom border-dark align-middle" data-fecha-servicio="{{ date('Y-m-d', strtotime($unid->fecha_servicio)) }}">
                                    <td class="text-muted-custom py-3">{{ $unid->id }}</td>
                                    <td class="py-3 text-nowrap">
                                        <a href="{{ route('monitoreo.moduloestadias', $unid->id) }}" class="text-gold font-weight-bold">
                                            {{ $unid->folio }}
                                        </a>
                                    </td>
                                    <td class="py-3 font-weight-bold">{{ $unid->nombre_cliente }}</td>
                                    <td class="py-3 text-truncate max-w-200" title="{{ $unid->dom_origen }}">{{ $unid->dom_origen }}</td>
                                    <td class="py-3 text-truncate max-w-200" title="{{ $unid->dom_destino }}">{{ $unid->dom_destino }}</td>
                                    <td class="py-3 text-nowrap text-white-50">{{ date('d/m/Y h:i A' , strtotime($unid->fecha_servicio)) }}</td>
                                    <td class="py-3 text-nowrap">{{ $unid->custodio->nombre_custodio }} {{ $unid->custodio->ap_paterno }}</td>
                                    <td class="py-3 text-nowrap">{{ $unid->tipo_servicio == 0 ? 'Foráneo' : 'Local' }}</td>
                                    <td class="py-3">
                                        <select class="form-control filter-input-custom text-white" id="programacion_id" name="programacion_id" data-programacion="{{ $unid->id }}">
                                            @foreach($estatus_programacion as $tp)
                                                <option value="{{ $tp->id }}" @selected($unid->programacion_estatus_id == $tp->id)>{{ $tp->estatus_programacion }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="py-3 text-nowrap text-muted-custom">{{ $unid->op_monitoreo_id == 1 ? 'Monitoreo 1' : 'Monitoreo 2' }}</td>
                                    <td class="py-3 text-center text-nowrap">
                                        <a href="{{ route('monitoreo.verprogramacionmon', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mt-1" title="Ver programación"><i class="flaticon-eye"></i></a>
                                        <a href="{{ route('monitoreo.moduloestadias', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mt-1" title="Generales transportes"><i class="flaticon-presentation-1"></i></a>
                                        <button class="btn btn-sm btn-outline-warning btn-icon mt-1" onClick="addincidenciaid({{ $unid->id }})" data-toggle="modal" data-target="#model_add_incidencia"><i class="flaticon-notepad"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
function toggleMapFullscreen() {
    var container = document.getElementById('map-container-fullscreen');
    if (!document.fullscreenElement) {
        if (container.requestFullscreen) { container.requestFullscreen(); }
        else if (container.mozRequestFullScreen) { container.mozRequestFullScreen(); }
        else if (container.webkitRequestFullscreen) { container.webkitRequestFullscreen(); }
        else if (container.msRequestFullscreen) { container.msRequestFullscreen(); }
    } else {
        if (document.exitFullscreen) { document.exitFullscreen(); }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var origenCoords = [19.4326, -99.1332]; 
    var posicionActual = [19.2843, -98.4346]; 
    var destinoCoords = [19.0414, -98.2063]; 

    var map = L.map('map-monitoring', {
        zoomControl: true,
        attributionControl: false
    }).setView(posicionActual, 10);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19
    }).addTo(map);

    L.circleMarker(origenCoords, { color: '#10b981', fillColor: '#10b981', fillOpacity: 1, radius: 6 }).addTo(map);
    L.circleMarker(destinoCoords, { color: '#ef4444', fillColor: '#ef4444', fillOpacity: 1, radius: 6 }).addTo(map);

    var markerActual = L.circleMarker(posicionActual, {
        color: '#3b82f6',
        fillColor: '#1e3a8a',
        fillOpacity: 0.8,
        weight: 3,
        radius: 9
    }).addTo(map);

    var popupContent = `
        <div style="color: #000; font-family: sans-serif; font-size: 11px; line-height: 14px;">
            <b style="color: #1e3a8a; text-transform: uppercase;">Posición Actual</b><br>
            <b>Carretera México - Puebla Km 85+300</b><br>
            Velocidad: 72 km/h
        </div>
    `;
    markerActual.bindPopup(popupContent).openPopup();

    L.polyline([origenCoords, posicionActual, destinoCoords], {
        color: '#3b82f6',
        weight: 4,
        opacity: 0.7,
        dashArray: '5, 5'
    }).addTo(map);

    document.addEventListener('fullscreenchange', function() {
        setTimeout(function(){ map.invalidateSize(); }, 200);
    });
});
</script>
@endsection