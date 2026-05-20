@extends('layouts.app')

@push('scripts')
  <script src="{{ asset('js/programacion/CatalogoProgramacion.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
  Listado de la programación
@endsection

@section('content')

<style>
    .dashboard-dark {
        background-color: #0b111e;
        color: #e2e8f0;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        border-radius: 8px;
    }
    .panel-dark {
        background-color: #121926;
        border: 1px solid #1e293b;
        border-radius: 6px;
        padding: 1.25rem;
    }
    .text-gold {
        color: #cda036 !important;
    }
    .btn-gold {
        background-color: #cda036;
        color: #000;
        font-weight: 600;
        border: none;
    }
    .btn-gold:hover {
        background-color: #b3882b;
        color: #000;
    }
    .custom-input {
        background-color: #1a2333 !important;
        border: 1px solid #2e3f56 !important;
        color: #fff !important;
    }
    .custom-input:focus {
        border-color: #cda036 !important;
    }
    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }
    .table-custom th {
        background-color: #172030;
        color: #94a3b8;
        font-size: 0.8rem;
        text-transform: uppercase;
        padding: 10px;
        border-bottom: 2px solid #1e293b;
    }
    .table-custom td {
        padding: 12px 10px;
        border-bottom: 1px solid #1e293b;
        font-size: 0.875rem;
    }
    .table-custom tbody tr:hover {
        background-color: #1a2436;
    }
    /* Badges de Estatus */
    .badge-status {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: bold;
        display: inline-block;
    }
    .status-programado { background-color: rgba(205, 160, 54, 0.2); color: #cda036; border: 1px solid #cda036; }
    .status-enruta { background-color: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid #10b981; }
    .status-encurso { background-color: rgba(59, 130, 246, 0.2); color: #3b82f6; border: 1px solid #3b82f6; }
    .status-sinasignar { background-color: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid #ef4444; }
    
    /* Indicadores de Riesgo y Disponibilidad */
    .risk-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    .bg-low { background-color: #10b981; }
    .bg-medium { background-color: #f59e0b; }
    .bg-high { background-color: #ef4444; }

    /* Caja de Alertas Estilo la Imagen */
    .alert-panel-red {
        background-color: rgba(239, 68, 68, 0.08);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 6px;
        padding: 1rem;
    }
</style>

<input type='hidden' id='url_estatus' value='{{ route('programacion.updatemonitoreoajax') }}'>

<div class="dashboard-container dashboard-dark p-6">
    
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h2 class="text-white font-weight-bold mb-1">PROGRAMACIÓN DE SERVICIOS</h2>
            <p class="text-muted m-0">Administra y programa los servicios de custodia y traslado.</p>
        </div>
        <div class="d-flex align-items-center">
            <div class="mr-3">
                <input type="date" class="form-control custom-input form-control-sm" value="2026-04-28">
            </div>
            <a href="{{ route('programacion.nuevaprogramacion') }}" class="btn btn-gold btn-sm font-weight-bold mr-2">
                <i class="la la-plus"></i> NUEVO SERVICIO
            </a>
            <button class="btn btn-outline-secondary text-white btn-sm mr-2">
                <i class="la la-file-excel"></i> IMPORTAR EXCEL
            </button>
            <button class="btn btn-outline-secondary text-white btn-sm">
                <i class="la la-download"></i> EXPORTAR
            </button>
        </div>
    </div>

    <div class="row">
        
        <div class="col-xl-3 mb-6 mb-xl-0">
            <div class="panel-dark">
                <h6 class="text-gold mb-4 font-weight-bold">DATOS DEL SERVICIO</h6>
                
                <form id="form_guardar_servicio">
                    <div class="form-group mb-3">
                        <label class="small text-muted">Cliente *</label>
                        <select class="form-control custom-input form-control-sm">
                            <option value="">Seleccionar cliente</option>
                            @foreach($data as $es)
                                <option value="{{ $es->id }}">{{ $es->nombre_cliente }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">No. Embarque</label>
                        <input type="text" class="form-control custom-input form-control-sm" placeholder="Ingrese número">
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">Origen *</label>
                        <select class="form-control custom-input form-control-sm">
                            <option>Seleccionar origen</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">Destino *</label>
                        <select class="form-control custom-input form-control-sm">
                            <option>Seleccionar destino</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="small text-muted">Fecha salida *</label>
                            <input type="date" class="form-control custom-input form-control-sm">
                        </div>
                        <div class="col-6">
                            <label class="small text-muted">Hora salida *</label>
                            <input type="time" class="form-control custom-input form-control-sm">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">Tipo de servicio *</label>
                        <select class="form-control custom-input form-control-sm">
                            <option>Custodia</option>
                            <option>Traslado</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">Unidad</label>
                        <select class="form-control custom-input form-control-sm">
                            <option>Seleccionar unidad</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-muted">Custodio asignado</label>
                        <select class="form-control custom-input form-control-sm">
                            <option>Seleccionar custodio</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="small text-muted d-block mb-2">Nivel de riesgo</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="risk" id="riskLow" autocomplete="off">
                            <label class="btn btn-outline-success btn-sm" for="riskLow">BAJO</label>

                            <input type="radio" class="btn-check" name="risk" id="riskMed" autocomplete="off" checked>
                            <label class="btn btn-outline-warning btn-sm" for="riskMed">MEDIO</label>

                            <input type="radio" class="btn-check" name="risk" id="riskHigh" autocomplete="off">
                            <label class="btn btn-outline-danger btn-sm" for="riskHigh">ALTO</label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="small text-muted">Observaciones</label>
                        <textarea class="form-control custom-input form-control-sm" rows="2" placeholder="Ingrese observaciones..."></textarea>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <button type="reset" class="btn btn-dark btn-sm w-100 text-muted border-secondary">LIMPIAR</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-gold btn-sm w-100">GUARDAR</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-gold btn-block btn-sm py-2">PROGRAMAR SERVICIO</button>
                </form>
            </div>
        </div>

        <div class="col-xl-6 mb-6 mb-xl-0">
            <div class="panel-dark p-0">
                <div class="p-4 d-flex justify-content-between align-items-center border-bottom border-dark">
                    <h6 class="text-gold m-0 font-weight-bold">SERVICIOS PROGRAMADOS ({{ $programcion->count() }})</h6>
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control custom-input form-control-sm w-180px mr-2" placeholder="Buscar servicio...">
                        <button class="btn btn-dark btn-sm custom-input"><i class="la la-filter"></i></button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Hora salida</th>
                                <th>Cliente</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Custodio</th>
                                <th>Estatus</th>
                                <th>Riesgo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programcion as $unid)
                            <tr>
                                <td class="font-weight-bold text-white">{{ date('H:i', strtotime($unid->fecha_servicio)) }}</td>
                                <td>{{ $unid->nombre_cliente }}</td>
                                <td>{{ $unid->dom_origen }}</td>
                                <td>{{ $unid->dom_destino }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-20 symbol-circle mr-2 bg-secondary d-flex align-items-center justify-content-center" style="width:22px; height:22px;">
                                            <span class="text-white small font-weight-bold" style="font-size:0.7rem;">
                                                {{ $unid->custodio ? substr($unid->custodio->nombre_custodio, 0, 1) : '-' }}
                                            </span>
                                        </div>
                                        <span class="small text-white-50">
                                            {{ $unid->custodio ? $unid->custodio->nombre_custodio : 'Sin asignar' }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @if($unid->estatus == 1)
                                        <span class="badge-status status-programado">PROGRAMADO</span>
                                    @elseif($unid->estatus == 2)
                                        <span class="badge-status status-enruta">EN RUTA</span>
                                    @else
                                        <span class="badge-status status-sinasignar">SIN ASIGNAR</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="risk-dot {{ $unid->estatus == 1 ? 'bg-medium' : 'bg-low' }}"></span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown dropdown-inline">
                                        <button class="btn btn-clean btn-hover-light-primary btn-sm btn-icon text-muted" data-toggle="dropdown">
                                            <i class="la la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="navi navi-hover flex-column p-2">
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link py-1" onclick="agregarIncidencia({{ $unid->id }})">
                                                        <i class="la la-comment-alt mr-2"></i> Observación
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link text-danger py-1" onclick="eliminarProgramacion({{ $unid->id }})">
                                                        <i class="la la-trash mr-2 text-danger"></i> Desactivar
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-3 d-flex justify-content-between align-items-center border-top border-dark fs-xs">
                    <span class="text-muted small">Mostrando 1 a {{ $programcion->count() }} servicios</span>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-dark btn-xs custom-input px-2 py-1 mr-1"><i class="la la-angle-left"></i></button>
                        <button class="btn btn-gold btn-xs px-2 py-1 mr-1">1</button>
                        <button class="btn btn-dark btn-xs custom-input px-2 py-1 mr-1"><i class="la la-angle-right"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="panel-dark mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-gold m-0 font-weight-bold">DISPONIBILIDAD</h6>
                    <a href="#" class="text-info small text-decoration-none">Ver todas</a>
                </div>
                
                <p class="text-muted small font-weight-bold mb-2">CUSTODIOS</p>
                <div class="d-flex flex-column g-2 mb-3">
                    <div class="small mb-1"><span class="risk-dot bg-low mr-2"></span> Juan Pérez <span class="text-muted">(Disponible)</span></div>
                    <div class="small mb-1"><span class="risk-dot bg-low mr-2"></span> Carlos Ruiz <span class="text-muted">(Disponible)</span></div>
                    <div class="small mb-1"><span class="risk-dot bg-medium mr-2"></span> Miguel Torres <span class="text-muted">(En servicio)</span></div>
                </div>

                <p class="text-muted small font-weight-bold mb-2">UNIDADES</p>
                <div class="d-flex flex-column g-2">
                    <div class="small mb-1"><span class="risk-dot bg-low mr-2"></span> U-01 <span class="text-muted">(Disponible)</span></div>
                    <div class="small mb-1"><span class="risk-dot bg-medium mr-2"></span> U-02 <span class="text-muted">(En ruta)</span></div>
                    <div class="small mb-1"><span class="risk-dot bg-high mr-2"></span> U-03 <span class="text-muted">(Mantenimiento)</span></div>
                </div>
                
                <a href="{{ route('programacion.programacioninactivas') }}" class="btn btn-outline-secondary btn-sm text-white w-100 mt-4 border-secondary fs-xs">
                    <i class="far fa-trash-alt mr-1"></i> CLIENTES INACTIVOS
                </a>
            </div>

            <div class="alert-panel-red">
                <h6 class="text-danger font-weight-bold mb-3 small">ALERTAS DE PROGRAMACIÓN</h6>
                
                <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom border-dark row-link">
                    <span class="small text-white"><i class="fa fa-exclamation-triangle text-danger mr-2"></i> 3 servicios sin custodio</span>
                    <i class="fa fa-chevron-right text-muted small"></i>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom border-dark row-link">
                    <span class="small text-white"><i class="fa fa-exclamation-triangle text-warning mr-2"></i> 2 servicios sin unidad</span>
                    <i class="fa fa-chevron-right text-muted small"></i>
                </div>
                <div class="d-flex justify-content-between align-items-center row-link">
                    <span class="small text-white"><i class="fa fa-exclamation-triangle text-danger mr-2"></i> 1 servicio con riesgo alto</span>
                    <i class="fa fa-chevron-right text-muted small"></i>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="dashboard-dark p-4 mt-3 rounded d-flex justify-content-between align-items-center panel-dark border-0">
    <div class="d-flex align-items-center flex-wrap">
        <span class="small text-muted font-weight-bold mr-3">LEYENDA DE ESTATUS:</span>
        <span class="badge-status status-programado mr-2">PROGRAMADO</span>
        <span class="badge-status status-encurso mr-2">EN CURSO</span>
        <span class="badge-status status-enruta mr-2">EN RUTA</span>
        <span class="badge-status status-sinasignar">SIN ASIGNAR</span>
    </div>
    <div class="d-flex align-items-center">
        <span class="small text-muted font-weight-bold mr-3">LEYENDA DE RIESGO:</span>
        <span class="small mr-3"><span class="risk-dot bg-low mr-1"></span> BAJO</span>
        <span class="small mr-3"><span class="risk-dot bg-medium mr-1"></span> MEDIO</span>
        <span class="small"><span class="risk-dot bg-high mr-1"></span> ALTO</span>
    </div>
</div>

<form method="post" id="programacion_delete_form" action="{{ route('programacion.deasactivarprogramacion') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_programacion_delete" value="">
</form>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="model_add_incidencia">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-gold">Observaciones</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('programacion.guardarobservacion') }}" method="post" id="submit_incidencia">
                    @csrf
                    <div class="form-group">
                        <label class="text-white-50">Observación</label>
                        <textarea class="form-control custom-input" name="observacion" id="observacion" rows="4"></textarea>
                        <input type="hidden" name="id" id="id_programacion">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary font-weight-bold btn-sm" data-dismiss="modal"><i class="la la-times"></i> Cancelar</button>
                <button type="button" id="send_incidencia" class="btn btn-gold btn-sm"><i class="la la-plus"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Helpers de interacción básica para complementar tu script CatalogoProgramacion.js
    function agregarIncidencia(id) {
        $('#id_programacion').val(id);
        $('#model_add_incidencia').modal('show');
    }

    function eliminarProgramacion(id) {
        if(confirm('¿Seguro que deseas desactivar esta programación?')) {
            $('#id_programacion_delete').val(id);
            $('#programacion_delete_form').submit();
        }
    }
</script>

@endsection