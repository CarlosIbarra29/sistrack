@extends('layouts.app')
@push('scripts')
  <script src="{{ asset('js/programacion/CatalogoProgramacion.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script src="{{ asset('js/programacion/AgregarProgramacionUnique.js') }}"></script>
@endpush

@section('title')
  Programación de Servicios
@endsection

@section('content')
<div class="dashboard-dark p-4">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6" style="gap: 15px;">
        <div>
            <h2 class="text-white font-weight-bold mb-1" style="font-size: calc(1.3rem + 0.6vw);">PROGRAMACIÓN DE SERVICIOS</h2>
            <p class="text-muted small mb-0">Administra y programa los servicios de custodia y traslado.</p>
        </div>
        <div class="d-flex flex-wrap align-items-center w-100 w-md-auto" style="gap: 10px;">
            <a href="{{ route('programacion.nuevaprogramacion') }}" class="btn btn-gold d-flex align-items-center px-4 py-2 flex-grow-1 flex-md-grow-0 justify-content-center">
                <i class="la la-plus mr-2"></i> NUEVO SERVICIO
            </a>
            <a href="{{ route('programacion.programacioninactivas') }}" class="btn btn-outline-custom btn-sm d-flex align-items-center flex-grow-1 flex-md-grow-0 justify-content-center">
                <i class="far fa-trash-alt mr-2"></i> CLIENTES INACTIVOS
            </a>
            <button class="btn btn-outline-custom btn-sm flex-grow-1 flex-md-grow-0">
                <i class="fa fa-file-excel mr-2"></i> IMPORTAR EXCEL
            </button>
            <button class="btn btn-outline-custom btn-sm flex-grow-1 flex-md-grow-0">
                <i class="fa fa-download mr-2"></i> EXPORTAR
            </button>
        </div>
    </div>



                                      {{--DATOS DEL SERVICIO--}}
    <div class="row mb-5">
        <div class="col-xl-3 mb-4">
            <div class="panel-dark">
                <h6 class="text-gold mb-4 font-weight-bold">DATOS DEL SERVICIO</h6>
                <form action="{{ route('programacion.guardarprogramacionnew') }}" 
                  method="post" 
                  id="submit_programacion" 
                  enctype="multipart/form-data">
                  @csrf
                  <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                     <!-- SECCIÓN 1: CLIENTE Y TIEMPO -->
                    <div class="form-row-section">
                        <div class="section-meta">
                            <h3>Origen</h3>
                            <p>Defina el cliente solicitante, el horario de salida del servicio y las variables de monitoreo.</p>
                        </div>
                        <div class="section-controls">
                            <div class="form-group row">
                                <div class="col-md-7 mb-4">
                                    <label class="app-label">Razón Social *</label>
                                    <select class="form-control app-input" id="cliente_id" name="cliente_id" required>
                                        <option value="" disabled selected>Buscar y seleccionar cliente...</option>
                                       @foreach($cliente as $cli)
                                            <option value="{{ $cli->id }}">{{ $cli->nombre_cliente }} / {{ $cli->razon_social }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 mb-4">
                                    <label class="app-label">Fecha y hora de servicio *</label>
                                    <input type="datetime-local" class="form-control app-input" name="fecha_hora" id="fecha_hora" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-4 mb-3">
                                    <label class="app-label">Tipo de servicio</label>
                                    <div class="compact-radio-group">
                                        <label class="compact-radio-item">
                                            <input type="radio" checked name="tipo_servicio" value="0">
                                            <span>Foráneo</span>
                                        </label>
                                        <label class="compact-radio-item">
                                            <input type="radio" name="tipo_servicio" value="1">
                                            <span>Local</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="app-label">Armado</label>
                                    <div class="compact-radio-group">
                                        <label class="compact-radio-item">
                                            <input type="radio" checked name="armado_servicio" value="1">
                                            <span>Sí</span>
                                        </label>
                                        <label class="compact-radio-item">
                                            <input type="radio" name="armado_servicio" value="2">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                        <!-- SECCIÓN 3: GEOLOCALIZACIÓN -->
                    <div class="form-row-section">
                        <div class="section-meta">
                            <h3>Rutas</h3>
                            <p>Puntos geográficos controlados de partida y destino.</p>
                        </div>
                        <div class="section-controls">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 mb-3">
                                    <label class="app-label">Domicilio origen *</label>
                                    <input type="text" class="form-control app-input" name="dom_origen" id="dom_origen" placeholder="Dirección origen del servicio" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="app-label">Domicilio destino *</label>
                                    <input type="text" class="form-control app-input" name="dom_destino" id="dom_destino" placeholder="Dirección destino del servicio" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- SECCIÓN 4: ASIGNACIÓN OPERATIVA -->
                    <div class="form-row-section">
                        <div class="section-meta">
                            <h3>Personal</h3>
                            <p>Gestione el custodio principal al mando de la unidad y acompañantes secundarios.</p>
                        </div>
                        <div class="section-controls">
                            <div class="form-group row align-items-end">
                                <div class="col-md-7 mb-4">
                                    <label class="app-label">Custodio Principal *</label>
                                    <select class="form-control app-input" id="custodio_id" name="custodio_id" required >
                                        <option value="" disabled selected>Asignar custodio...</option>
                                        @foreach($custodio as $cli)
                                            <option value="{{ $cli->id }}" >{{ $cli->nombre_custodio }} {{ $cli->ap_paterno }} {{ $cli->ap_materno }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-5 mb-4">
                                    <label class="app-label">¿Lleva Acompañantes?</label>
                                    <div class="compact-radio-group">
                                        <label class="compact-radio-item">
                                            <input type="radio" name="op_custodios" id="op_c_uno" value="0" />
                                            <span>Sí</span>
                                        </label>
                                        <label class="compact-radio-item">
                                            <input type="radio" checked name="op_custodios" id="op_c_dos" value="1" />
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Bloque dinámico integrado --}}
                            <div class="p-5 rounded mb-0" id="div_custodios" style="display: none; background-color: #111827; border: 1px solid #2e3b4e;">
                                <label class="app-label mb-3">Acompañantes Extras</label>
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered m-0 text-white" id="tblDocumentos" style="border-color: #2e3b4e;">
                                        <thead>
                                            <tr style="background-color: #1a2332;">
                                                <th class="border-0 py-2">Custodio</th>
                                                <th class="border-0 py-2 text-center" style="width: 80px;">Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyDocumentos"></tbody>
                                    </table>
                                </div>
                                <a href="#" class="btn btn-action-secondary btn-sm hrefAgregarOtro">
                                    <i class="flaticon2-plus small"></i> Agregar otro
                                </a>
                            </div>
                        </div>


                        <!-- SECCIÓN 5: ANOTACIONES FINALES -->
                    <div class="form-row-section">
                        <div class="section-meta">
                            <h3>Notas</h3>
                            <p>Observaciones críticas u operacionales a considerar.</p>
                        </div>
                        <div class="section-controls">
                            <div class="form-group mb-0">
                                <textarea class="form-control app-input" name="observaciones" placeholder="Escriba comentarios adicionales aquí..." id="observaciones" rows="3"></textarea>
                            </div>
                        </div>
                    </div>


                    <!-- ACCIONES -->
                    <div class="panel-footer-actions d-flex justify-content-end align-items-center">
                        <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-action-secondary mr-3">
                            Limpiar Todo
                        </a>
                        <button type="button" id="btnGuardar" class="btn btn-action-primary">
                            Guardar Registro
                        </button>
                    </div>
                </form>
            </div>           
         </div>
    </div>



















{{--SERVICIOS PROGRAMADOS--}}


        <div class="col-xl-6 mb-4">
            <div class="panel-dark p-0 overflow-hidden">
                <div class="p-4 d-flex justify-content-between align-items-center border-bottom border-dark">
                    <h6 class="text-gold m-0 font-weight-bold">SERVICIOS PROGRAMADOS ({{ $programcion->count() }})</h6>
                    <input type="text" class="form-control custom-input form-control-sm w-200px" placeholder="Buscar servicio...">
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
                                <td class="text-muted">{{ $unid->dom_origen }}</td>
                                <td class="text-muted">{{ $unid->dom_destino }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-20 symbol-circle mr-2 bg-secondary d-flex align-items-center justify-content-center" style="width:24px; height:24px;">
                                            <span class="text-white small font-weight-bold" style="font-size:10px;">{{ substr($unid->custodio->nombre_custodio ?? 'S', 0, 1) }}</span>
                                        </div>
                                        <span class="small text-white">{{ $unid->custodio->nombre_custodio ?? 'Sin asignar' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-status status-programado">PROGRAMADO</span>
                                </td>
                                <td class="text-center"><span class="risk-dot bg-medio"></span></td>
                                <td class="text-center">
                                    <a href="#" class="text-gold mx-1" data-toggle="modal" data-target="#model_add_incidencia" onclick="$('#id_programacion').val({{ $unid->id }})">
                                        <i class="flaticon-eye"></i>
                                    </a>

                                <a href="{{ route('programacion.editarprogramacion', $unid->id) }}" class="btn btn-xs btn-icon btn-clean text-muted p-0" title="Editar programcion"><i class="la la-edit font-size-lg"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-3 mb-4 d-flex flex-column" style="gap: 20px;">
            
            <div class="panel-dark" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="text-gold font-weight-bold m-0" style="letter-spacing: 0.5px; font-size: 14px;">DISPONIBILIDAD</h6>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-white small font-weight-bold" style="letter-spacing: 0.5px; font-size: 11px;">CUSTODIOS</span>
                    <a href="#" class="text-info small" style="font-size: 11px; color: #7c4dff !important;">Ver todas</a>
                </div>
                
                <div class="d-flex flex-column mb-3" style="gap: 14px;">
                    <div class="d-flex align-items-center small text-white">
                        <span class="risk-dot bg-bajo mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">Juan Pérez</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">Disponible</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small text-white">
                        <span class="risk-dot bg-bajo mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">Carlos Ruiz</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">Disponible</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small text-white">
                        <span class="risk-dot bg-medio mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">Miguel Torres</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">En servicio</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small text-white">
                        <span class="risk-dot bg-bajo mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">José Martínez</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">Disponible</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small text-white mb-2">
                        <span class="risk-dot bg-alto mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">Pedro López</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">No disponible</div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center pt-2">
                    <a href="#" class="text-gold font-weight-bold small" style="font-size: 11px; letter-spacing: 0.5px;">
                        VER TODOS LOS CUSTODIOS &rarr;
                    </a>
                </div>
            </div>

            <div class="panel-dark" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-white small font-weight-bold" style="letter-spacing: 0.5px; font-size: 11px;">UNIDADES</span>
                    <a href="#" class="text-info small" style="font-size: 11px; color: #7c4dff !important;">Ver todas</a>
                </div>
                
                <div class="d-flex flex-column mb-3" style="gap: 14px;">
                    <div class="d-flex align-items-center small text-white">
                        <span class="risk-dot bg-bajo mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">U-01</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">Disponible</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small text-white">
                        <span class="risk-dot bg-bajo mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">U-05</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">Disponible</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small text-white">
                        <span class="risk-dot bg-medio mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">U-02</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">En ruta</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small text-white">
                        <span class="risk-dot bg-alto mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">U-03</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">Mantenimiento</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small text-white mb-2">
                        <span class="risk-dot bg-bajo mr-3"></span>
                        <div>
                            <div class="font-weight-bold" style="font-size: 12px;">U-07</div>
                            <div class="text-muted" style="font-size: 10px; margin-top: 2px;">Disponible</div>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-2">
                    <a href="#" class="text-gold font-weight-bold small" style="font-size: 11px; letter-spacing: 0.5px;">
                        VER TODAS LAS UNIDADES &rarr;
                    </a>
                </div>
            </div>

            <div class="panel-dark" style="background-color: rgba(239, 68, 68, 0.04); border: 1px solid rgba(239, 68, 68, 0.15); padding: 20px;">
                <h6 class="text-danger small font-weight-bold mb-4" style="letter-spacing: 0.5px; font-size: 12px;">ALERTAS DE PROGRAMACIÓN</h6>
                
                <div class="d-flex flex-column" style="gap: 16px;">
                    <div class="d-flex justify-content-between align-items-center small text-white">
                        <span class="d-flex align-items-center" style="font-size: 12px;">
                            <i class="fa fa-exclamation-triangle text-danger mr-3" style="font-size: 13px;"></i> 
                            3 servicios sin custodio
                        </span>
                        <i class="fa fa-chevron-right text-muted" style="font-size: 10px;"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center small text-white">
                        <span class="d-flex align-items-center" style="font-size: 12px;">
                            <i class="fa fa-exclamation-triangle text-warning mr-3" style="font-size: 13px;"></i> 
                            2 servicios sin unidad
                        </span>
                        <i class="fa fa-chevron-right text-muted" style="font-size: 10px;"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center small text-white">
                        <span class="d-flex align-items-center" style="font-size: 12px;">
                            <i class="fa fa-exclamation-triangle text-danger mr-3" style="font-size: 13px;"></i> 
                            1 servicio con riesgo alto
                        </span>
                        <i class="fa fa-chevron-right text-muted" style="font-size: 10px;"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="panel-dark py-3 px-4 mt-4">
        <div class="row align-items-center">
            <div class="col-xl-8 border-right border-secondary">
                <h6 class="text-gold font-weight-bold mb-3" style="font-size: 12px; letter-spacing: 0.5px;">LEYENDA DE ESTATUS</h6>
                <div class="d-flex flex-wrap align-items-center" style="gap: 20px;">
                    <div class="small"><span class="badge-status status-programado mr-2">PROGRAMADO</span> <span class="text-muted" style="font-size: 11px;">Servicio programado</span></div>
                    <div class="small"><span class="badge-status status-encurso mr-2">EN CURSO</span> <span class="text-muted" style="font-size: 11px;">Servicio activo</span></div>
                    <div class="small"><span class="badge-status status-enruta mr-2">EN RUTA</span> <span class="text-muted" style="font-size: 11px;">En ruta al destino</span></div>
                    <div class="small"><span class="badge-status status-finalizado mr-2">FINALIZADO</span> <span class="text-muted" style="font-size: 11px;">Servicio finalizado</span></div>
                    <div class="small"><span class="badge-status status-sinasignar mr-2">SIN ASIGNAR</span> <span class="text-muted" style="font-size: 11px;">Pendiente por asignar</span></div>
                </div>
            </div>
            <div class="col-xl-4 pl-xl-4">
                <h6 class="text-gold font-weight-bold mb-3" style="font-size: 12px; letter-spacing: 0.5px;">LEYENDA DE RIESGO</h6>
                <div class="d-flex align-items-center justify-content-between" style="background-color: rgba(255,255,255,0.02); padding: 6px 12px; border-radius: 6px; border: 1px solid var(--border-color);">
                    <div class="small d-flex align-items-center"><span class="risk-dot bg-bajo mr-2"></span> <strong>BAJO</strong> <span class="text-muted ml-1" style="font-size: 10px;">Riesgo bajo</span></div>
                    <div class="small d-flex align-items-center"><span class="risk-dot bg-medio mr-2"></span> <strong>MEDIO</strong> <span class="text-muted ml-1" style="font-size: 10px;">Riesgo medio</span></div>
                    <div class="small d-flex align-items-center"><span class="risk-dot bg-alto mr-2"></span> <strong>ALTO</strong> <span class="text-muted ml-1" style="font-size: 10px;">Riesgo alto</span></div>
                </div>
            </div>
        </div>
    </div>

</div>

<input type='hidden' id='url_estatus' value='{{ route('programacion.updatemonitoreoajax') }}'>

<form method="post" id="programacion_delete_form" action="{{ route('programacion.deasactivarprogramacion') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_programacion_delete" value="">
</form>

<div class="modal fade" tabindex="-1" role="dialog" id="model_add_incidencia">
    <div class="modal-dialog modal-dialog-centered">
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
                        <label class="text-muted">Observación</label>
                        <textarea class="form-control custom-input" name="observacion" id="observacion" rows="4"></textarea>
                        <input type="hidden" name="id" id="id_programacion">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-outline-custom" data-dismiss="modal">Cancelar</button>
                <button type="button" id="send_incidencia" class="btn btn-gold">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection