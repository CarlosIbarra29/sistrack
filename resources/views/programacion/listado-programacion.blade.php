@extends('layouts.app')
@push('scripts')
  <script src="{{ asset('js/programacion/CatalogoProgramacion.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
  Listado de la programación
@endsection
@section('content')

{{--     <div class="d-flex flex-row">
    <div class="flex-row-fluid">
        <div class="d-flex flex-column flex-grow-1">

            <div class="row">
                <div class="col-xl-12">

                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                      <span class="card-icon">
                        <i class="flaticon2-file text-primary"></i>
                      </span>
                                <h3 class="card-label">Inventario de programación</h3>
                            </div>
                            <div class="card-toolbar">

                                <a class="btn btn-link-primary font-weight-bold mr-2 busqueda" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Busqueda
                                </a>

                                  <a href="{{ route('programacion.nuevaprogramacion') }}" class="btn btn-light-primary font-weight-bolder mr-3 ml-3" >
                                  <i class="la la-plus"></i>Nuevo</a>

                                <a href="{{ route('programacion.programacioninactivas') }}" class="btn btn-light-primary font-weight-bolder mr-3 ml-3">
                                    <i class="far fa-trash-alt"></i>Programación inactivas</a>

                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="svg-icon svg-icon-md">
                                      <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24" />
                                          <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                          <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                        </g>
                                      </svg>

                                      </span>Exportar
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">

                                        <ul class="navi flex-column navi-hover py-2">
                                            <li class="navi-item">
                                              <a href="#" class="navi-link" id="export-excel">
                                                <span class="navi-icon">
                                                  <i class="la la-file-excel-o"></i>
                                                </span>
                                                <span class="navi-text">Excel</span>
                                              </a>
                                            </li>
                                            <li class="navi-item">
                                              <a href="#" class="navi-link" id="export-csv">
                                                <span class="navi-icon">
                                                  <i class="la la-file-text-o"></i>
                                                </span>
                                                <span class="navi-text">CSV</span>
                                              </a>
                                            </li>
                                            <li class="navi-item">
                                              <a href="#" class="navi-link" id="export-print">
                                                <span class="navi-icon">
                                                  <i class="la la-file-text-o"></i>
                                                </span>
                                                <span class="navi-text">Imprimir</span>
                                              </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                          <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                                <form class="mb-15">
                                  <div class="row mb-6">
                                    <div class="col-lg-6 mb-lg-0 mb-6">
                                        <label>Cliente:</label>
                                        <select class="form-control datatable-input" name="nombre_cliente" data-control="select2" data-placeholder="Estado" data-col-index="0">
                                            <option value="0">Selecciona un cliente</option>
                                            @foreach($data as $es)
                                                <option value="{{ $es->id }}" >{{ $es->nombre_cliente }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                  </div>

                                  <div class="row mt-8">
                                    <div class="col-lg-12">
                                      <button class="btn btn-primary btn-primary--icon" id="kt_search">
                                        <span><i class="la la-search"></i><span>Buscar</span></span>
                                      </button>&#160;&#160;
                                      <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                        <span><i class="la la-close"></i><span>Limpiar</span></span>
                                      </button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                          </div>

                            <table class="table table-hover table-checkable" id="kdatatable_programacion">
                                <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Folio</th>
                                  <th>Cliente</th>
                                  <th>Domicilio origen</th>
                                  <th>Domicilio destino</th>
                                  <th>Fecha y Hora</th>
                                  <th>Tipo de servicio</th>
                                  <th>Estatus</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                  <th>No.</th>
                                  <th>Folio</th>
                                  <th>Cliente</th>
                                  <th>Domicilio origen</th>
                                  <th>Domicilio destino</th>
                                  <th>Fecha y Hora</th>
                                  <th>Tipo de servicio</th>
                                  <th>Estatus</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                                </tfoot>

                            </table>

                            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                            <input type="hidden" id="programaciondatatable" value="{{ route('programacion.programaciondatatable') }}">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> --}}

  <input type='hidden' id='url_estatus' value='{{ route('programacion.updatemonitoreoajax') }}'>

    <div class="d-flex flex-row">

    <!--begin::List-->
    <div class="flex-row-fluid">
        <div class="d-flex flex-column flex-grow-1">

            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-12">

                <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                      <span class="card-icon">
                        <i class="flaticon2-file text-warning"></i>
                      </span>
                                <h3 class="card-label">Inventario de Programación</h3>
                            </div>
                            

                                <div class="dashboard-container p-5">
    <!-- Header Superior -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            
            <p class="text-muted small">Administra y programa los servicios de custodia y traslado.</p>
        </div>
        <div class="d-flex align-items-center">
    <!-- Botón Nuevo Servicio (con tu ruta original) -->
    <a href="{{ route('programacion.nuevaprogramacion') }}" class="btn btn-gold mr-2 d-flex align-items-center">
        <i class="la la-plus mr-1"></i> NUEVO SERVICIO
    </a>

    <!-- Botón Clientes Inactivos (con tu ruta original) -->
    <a href="{{ route('programacion.programacioninactivas') }}" class="btn btn-outline-secondary text-white btn-sm mr-2 d-flex align-items-center">
        <i class="far fa-trash-alt mr-1"></i> CLIENTES INACTIVOS
    </a>

    <!-- Botón Importar (se mantiene por diseño) -->
    <button class="btn btn-outline-secondary text-white btn-sm mr-2">
        <i class="fa fa-file-excel mr-1"></i> IMPORTAR EXCEL
    </button>

    <!-- Botón Exportar (se mantiene por diseño) -->
    <button class="btn btn-outline-secondary text-white btn-sm">
        <i class="fa fa-download mr-1"></i> EXPORTAR
    </button>
</div>
    </div>

    <div class="row">
        <!-- 1. PANEL IZQUIERDO: FORMULARIO -->
        <div class="col-xl-3">
            <div class="panel-dark">
                <h6 class="text-gold mb-4 font-weight-bold">DATOS DEL SERVICIO</h6>
                <div class="form-group">
                    <label class="small">Cliente *</label>
                    <select class="form-control custom-input"><option>Seleccionar cliente</option></select>
                </div>
                <div class="form-group">
                    <label class="small">Origen *</label>
                    <select class="form-control custom-input"><option>Seleccionar origen</option></select>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label class="small">Fecha salida *</label>
                        <input type="date" class="form-control custom-input">
                    </div>
                    <div class="col-6 form-group">
                        <label class="small">Hora salida *</label>
                        <input type="time" class="form-control custom-input">
                    </div>
                </div>
                
                <label class="small">Nivel de riesgo</label>
                <div class="d-flex mb-4">
                    <button class="btn btn-sm btn-outline-success flex-grow-1 mr-1">BAJO</button>
                    <button class="btn btn-sm btn-outline-warning flex-grow-1 mr-1">MEDIO</button>
                    <button class="btn btn-sm btn-outline-danger flex-grow-1">ALTO</button>
                </div>

                <div class="form-group">
                    <label class="small">Observaciones</label>
                    <textarea class="form-control custom-input" rows="3" placeholder="Ingrese observaciones..."></textarea>
                </div>

                <div class="d-flex mt-4">
                    <button class="btn btn-dark btn-sm flex-grow-1 mr-2 border-secondary">LIMPIAR</button>
                    <button class="btn btn-gold btn-sm flex-grow-1">GUARDAR</button>
                </div>
                <button class="btn btn-gold btn-block mt-2 py-3">PROGRAMAR SERVICIO</button>
            </div>
        </div>

        <!-- 2. PANEL CENTRAL: TABLA -->
        <div class="col-xl-6">
            <div class="panel-dark p-0">
                <div class="p-4 d-flex justify-content-between align-items-center">
                    <h6 class="text-gold m-0">SERVICIOS PROGRAMADOS ({{ $programcion->count() }})</h6>
                    <input type="text" class="form-control custom-input w-200px" placeholder="Buscar servicio...">
                </div>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programcion as $unid)
                        <tr>
                            <td class="font-weight-bold">{{ date('H:i', strtotime($unid->fecha_servicio)) }}</td>
                            <td>{{ $unid->nombre_cliente }}</td>
                            <td>{{ $unid->dom_origen }}</td>
                            <td>{{ $unid->dom_destino }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-25 symbol-circle mr-2 bg-light">
                                        <span class="text-dark small">{{ substr($unid->custodio->nombre_custodio, 0, 1) }}</span>
                                    </div>
                                    <span class="small">{{ $unid->custodio->nombre_custodio }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge-status status-programado">PROGRAMADO</span>
                            </td>
                            <td><span class="risk-dot bg-medium"></span></td>
                            <td><i class="flaticon-eye text-muted"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. PANEL DERECHO: DISPONIBILIDAD Y ALERTAS -->
        <div class="col-xl-3">
            <div class="panel-dark mb-4">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="text-gold small m-0">DISPONIBILIDAD</h6>
                    <a href="#" class="text-info small">Ver todas</a>
                </div>
                <p class="text-muted small mb-2">CUSTODIOS</p>
                <div class="small mb-2"><span class="risk-dot bg-low mr-2"></span> Juan Pérez (Disponible)</div>
                <div class="small mb-4"><span class="risk-dot bg-medium mr-2"></span> Carlos Ruiz (En servicio)</div>
                
                <p class="text-muted small mb-2">UNIDADES</p>
                <div class="small mb-1"><span class="risk-dot bg-low mr-2"></span> U-01 (Disponible)</div>

                
                <h6 class="text-danger small font-weight-bold">ALERTAS DE PROGRAMACIÓN</h6>
                <div class="d-flex justify-content-between align-items-center mt-3 small">
                    <span><i class="fa fa-exclamation-triangle text-danger mr-2"></i> 3 servicios sin custodio</span>
                    <i class="fa fa-chevron-right text-muted"></i>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2 small">
                    <span><i class="fa fa-exclamation-triangle text-warning mr-2"></i> 2 servicios sin unidad</span>
                    <i class="fa fa-chevron-right text-muted"></i>
                </div>
            
            </div>

            
        </div>
    </div>
</div>
</div>



  <form method="post" id="programacion_delete_form" action="{{ route('programacion.deasactivarprogramacion') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_programacion_delete" value="">
  </form>



  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="model_add_incidencia">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Observaciones</h5>
                  <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                      <span class="svg-icon svg-icon-2x"></span>
                  </div>
              </div>

              <div class="modal-body">
                <form action="{{ route('programacion.guardarobservacion') }}" method="post" id="submit_incidencia">
                @csrf
                  <div class="row form-group">
                    <div class="col-lg-12 mt-2">
                      <label>Observación</label>
                      <textarea class="form-control" name="observacion" id="observacion" ></textarea>
                      <input type="hidden" name="id" id="id_programacion">
                    </div>
                  </div>
                </form>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn btn-secondary font-weight-bold" data-dismiss="modal"><i class="la la-times"></i>Cancelar</button>
                <button type="button" id="send_incidencia" class="btn btn-warning"><i class="la la-plus"></i>Guardar</button>
              </div>
          </div>
      </div>
  </div>
</div>
                                

@endsection